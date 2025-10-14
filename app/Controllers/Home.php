<?php

namespace App\Controllers;

use App\Models\DocumentModel;
use App\Models\FireCaseModel;
use App\Models\PopulationModel;
use App\Models\RegisterUserModel;
use App\Models\RequestsModel;

class Home extends BaseController
{
    public function index(): string
    {
        $residentModel = new RegisterUserModel();
        $populationModel = new PopulationModel();
        $requestModel = new RequestsModel();
        $firecaseModel = new FireCaseModel();
        $documents = new DocumentModel();

        $requests = $requestModel->where('status', 'pending')
            ->where('is_deleted', 0)
            ->where('is_canceled', 0)->orderBy('DATE(created_at)', 'dsc')->findAll();

        $currentYear = date("Y");
        $data = [
            'requests' => $requests,
            'document' => $documents,
            'totalResidents' => $residentModel->where('is_deleted', 0)->countAllResults(),
            'totalPopulation' => $populationModel->where('is_deleted', 0)->countAllResults(),
            'totalActiveRequests' => $requestModel->where('status', 'pending')->countAllResults(),
            'firecase' => $firecaseModel->where('is_deleted', 0)->where('YEAR(date_report)', $currentYear)->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
    public function requests()
    {
        $model = new RequestsModel();
        $documentmodel = new DocumentModel();

        $status = $this->request->getGet('filter');
        $document = $this->request->getGet('document');
        $search = $this->request->getGet('search');


        $query = $model->where('is_deleted', 0)
            ->where('is_canceled', 0)->orderBy('id', 'dsc');


        if (empty($search) && empty($document)) {
            if (empty($status)) {
                $status = ['pending', 'approved', 'claimed'];
            }

            if (is_array($status)) {
                $query->whereIn('status', $status);
            } else {
                $query->where('status', $status);
            }
        }

        // ✅ FIX 2: Correctly filter by document type
        if (!empty($document)) {
            $query->where('request_type', $document);
        }

        // ✅ FIX 3: Add search filters correctly using groupStart/groupEnd
        if (!empty($search)) {
            $query->groupStart()
                ->like('firstname', $search)
                ->orLike('lastname', $search)
                ->orLike('middle_initial', $search)
                ->orLike('request_id', $search)
                ->orLike('contact_no', $search)
                ->orLike('purok', $search)
                ->groupEnd();
        }

        // ✅ FIX 4: Correct sort direction 'desc' instead of 'dsc'
        $requests = $query->orderBy('id', 'desc')->paginate(10);
        $pager = $model->pager;

        return view('admin/requests', [
            'pager' => $pager,
            'search' => $search,
            'document' => $documentmodel,
            'requests' => $requests,
            'status' => $status
        ]);
    }


    public function residence(): string
    {
        $residents = new RegisterUserModel();
        $query = $residents->where('is_deleted', 0);
        $search = $this->request->getGet('search');
        if ($search) {
            $query = $query
                ->groupStart()
                ->like('firstname', $search)
                ->orLike('lastname', $search)
                ->orLike('username', $search)
                ->orLike('purok', $search)
                ->orLike('user_id', $search)
                ->groupEnd();
        }
        $data['residents'] = $query->paginate(10);
        $data['pager'] = $residents->pager;
        $data['search'] = $search;
        return view('admin/residence_view', $data);
    }

    public function population()
    {
        $model = new PopulationModel();


        $query = $model->where('is_deleted', 0);


        $search = $this->request->getGet('search');
        if ($search) {
            $query->groupStart()
                ->like('firstname', $search)
                ->orLike('lastname', $search)
                ->orLike('purok', $search)
                ->orLike('resident_id', $search)
                ->groupEnd();
        }


        $selectedYear = $this->request->getGet('year');
        if ($selectedYear) {
            $query->where('census_year', $selectedYear);
        }


        $paginated = $query->orderBy('id', 'desc')->paginate(10);
        $pager = $model->pager;


        $groupedResidents = [];
        foreach ($paginated as $resident) {
            $year = $resident['census_year'];
            $groupedResidents[$year][] = $resident;
        }


        $availableYears = $model->select('census_year')
            ->distinct()
            ->orderBy('census_year', 'desc')
            ->findAll();

        $years = array_column($availableYears, 'census_year');

        return view('admin/population', [
            'groupedResidents' => $groupedResidents,
            'pager' => $pager,
            'search' => $search,
            'selectedYear' => $selectedYear,
            'years' => $years,
            'totalPopulation' => $model->where('is_deleted', 0)->countAllResults(),
        ]);
    }

    public function fire_list()
    {
        $model = new FireCaseModel();

        $query = $model->where('is_deleted', 0);

        $search = $this->request->getGet('search');
        if ($search) {
            $query->groupStart()
                ->like('cause_of_fire', $search)
                ->orLike('exact_location', $search)
                ->orLike('case_id', $search)
                ->groupEnd();
        }

        $selectedYear = $this->request->getGet('year');
        if ($selectedYear) {
            $query->where("YEAR(created_at)", $selectedYear);
        }

        $paginated = $query->orderBy('id', 'desc')->paginate(10);
        $pager = $model->pager;

        $groupedResidents = [];
        foreach ($paginated as $resident) {
            $year = date('Y', strtotime($resident['created_at']));
            $groupedResidents[$year][] = $resident;
        }

        $availableYears = $model->select("DISTINCT YEAR(created_at) as year")
            ->orderBy('year', 'desc')
            ->findAll();

        $years = array_column($availableYears, 'year');

        return view('admin/fire_list', [
            'groupedResidents' => $groupedResidents,
            'pager' => $pager,
            'search' => $search,
            'selectedYear' => $selectedYear,
            'years' => $years
        ]);
    }

    public function viewReport()
    {
        $requests = new RequestsModel();

        $filter = $this->request->getGet('month');

        
        if (!empty($filter)) {
            [$year, $months] = explode('-', $filter);
            $list = $requests->where('status', 'claimed')
                ->where('is_deleted', 0)
                ->where('Year(created_at)', $year)
                ->where('MONTH(created_at)', $months)
                ->findAll();

        } else {
            $list = $requests->where('status', 'claimed')->where('is_deleted', 0)->findAll();
        }

        $groupByMonth = [];

        foreach ($list as $l) {
            $month = date('Y-m', strtotime($l['created_at']));

            if (!isset($groupByMonth[$month])) {
                $groupByMonth[$month] = [];
            }

            $groupByMonth[$month][] = $l;
        }


        return view('admin/reports', ['lists' => $groupByMonth]);
    }
}

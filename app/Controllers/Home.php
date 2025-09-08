<?php

namespace App\Controllers;

use App\Models\PopulationModel;
use App\Models\RegisterUserModel;

class Home extends BaseController
{
    public function index(): string
    {
        $residentModel = new RegisterUserModel();
        $populationModel = new PopulationModel();
        // $requestModel = new \App\Models\RequestModel();

        $data = [
            'totalResidents' => $residentModel->where('is_deleted', 0)->countAllResults(),
            'totalPopulation' => $populationModel->where('is_deleted', 0)->countAllResults(),
            // 'totalActiveRequests' => $requestModel->where('status', 'pending')->countAllResults(), // or 'active'
        ];

        return view('admin/dashboard', $data);
    }
    public function requests()
    {
        return view('admin/requests');
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
            'years' => $years
        ]);
    }

    public function fire_list()
    {
        return view('admin/fire_list');
    }
}

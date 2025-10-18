<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EspSystem;
use App\Models\FireCaseModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class FireCaseController extends BaseController
{
    public function store()
    {
        $validation = Services::validation();

        $rules = [
            'date_occurrence' => 'required',
            'date_report' => 'required',
            'exact_location' => 'required',
            'cause_of_fire' => 'permit_empty',
            'affected_households' => 'required',
            'type_of_occupancy' => 'permit_empty',
            'casualties' => 'required',
            'affected_individuals' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = $this->UserId();

        $data = [
            'case_id' => $userId,
            'date_occurrence' => $this->request->getPost('date_occurrence'),
            'date_report' => $this->request->getPost('date_report'),
            'exact_location' => $this->request->getPost('exact_location'),
            'cause_of_fire' => $this->request->getPost('cause_of_fire'),
            'affected_households' => $this->request->getPost('affected_households'),
            'type_of_occupancy' => $this->request->getPost('type_of_occupancy'),
            'casualties' => $this->request->getPost('casualties'),
            'affected_individuals' => $this->request->getPost('affected_individuals'),
        ];

        $user = new FireCaseModel();
        $user->save($data);

        return redirect()->to('/admin/fire-list')
            ->with('success', 'Record Added Successfully');
    }

    public function alarm($id)
    {

        $userId = $this->UserId();

        $data = [
            'case_id' => $userId,
            'date_occurrence' => $this->request->getPost('date_occurrence'),
            'date_report' => $this->request->getPost('date_report'),
            'exact_location' => $this->request->getPost('exact_location'),
            'cause_of_fire' => $this->request->getPost('cause_of_fire'),
            'affected_households' => $this->request->getPost('affected_households'),
            'type_of_occupancy' => $this->request->getPost('type_of_occupancy'),
            'casualties' => $this->request->getPost('casualties'),
            'affected_individuals' => $this->request->getPost('affected_individuals'),
        ];

        $user = new FireCaseModel();
        $user->save($data);

        return redirect()->to('/admin/fire-list')
            ->with('success', 'Record Added Successfully');
    }

    public function update()
    {
        $record = new FireCaseModel();
        $id = $this->request->getPost('id');
        $validation = Services::validation();

        $rules = [
            'date_occurrence' => 'required',
            'date_report' => 'required',
            'exact_location' => 'required',
            'cause_of_fire' => 'permit_empty',
            'affected_households' => 'required',
            'type_of_occupancy' => 'permit_empty',
            'casualties' => 'required',
            'affected_individuals' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $findRecord = $record->where('id', $id)->first();
        if (!$findRecord) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        $data = [
            'date_occurrence' => $this->request->getPost('date_occurrence'),
            'date_report' => $this->request->getPost('date_report'),
            'exact_location' => $this->request->getPost('exact_location'),
            'cause_of_fire' => $this->request->getPost('cause_of_fire'),
            'affected_households' => $this->request->getPost('affected_households'),
            'type_of_occupancy' => $this->request->getPost('type_of_occupancy'),
            'casualties' => $this->request->getPost('casualties'),
            'affected_individuals' => $this->request->getPost('affected_individuals'),
        ];

        $record->update($id, $data);
        $case_id = $record->where('id', $id)->first();

        return redirect()->back()->with('success', $case_id['case_id'] . ' Record updated successfully!');
    }


    public function delete()
    {
        $record = new FireCaseModel();
        $id = $this->request->getPost('id');
        $find = $record->where('is_deleted', 0)->where('id', $id)->first();

        if ($find) {
            $data['is_deleted'] = 1;
            $record->update($id, $data);
            return redirect()->back()->with('success', $find['case_id'] . ' Deleted Successfully');
        }

        return redirect()->back()->with('error', $find['case_id'] . ' already deleted');
    }

    public function UserId()
    {
        $prefix = date('Ym');
        $fireCases = new FireCaseModel();

        $lastCase = $fireCases
            ->like('case_id', 'FC-' . $prefix . '-', 'after')
            ->orderBy('case_id', 'DESC')
            ->first();

        if ($lastCase) {
            $lastNumber = (int) substr($lastCase['case_id'], -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return 'FC-' . $prefix . '-' . $newNumber;
    }

    public function checkFireNotifications()
    {
        $fireModel = new FireCaseModel(); // adjust model name if different

        // Get all new fire cases that are not yet notified
        $fires = $fireModel
            ->where('is_notified', 0)
            ->where('is_deleted', 0) // optional, if you have soft deletes
            ->findAll();

        // Mark all as notified after sending them
        foreach ($fires as $fire) {
            $fireModel->update($fire['id'], ['is_notified' => 1]);
        }

        // Return JSON response
        return $this->response->setJSON([
            'status' => 200,
            'notifications' => $fires
        ]);
    }

}

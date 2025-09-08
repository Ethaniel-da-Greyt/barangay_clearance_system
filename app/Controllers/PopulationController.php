<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PopulationModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class PopulationController extends BaseController
{
    public function store()
    {
        $validation = Services::validation();

        $rules = [
            'firstname' => 'required',
            'middle_initial' => 'permit_empty',
            'lastname' => 'required',
            'suffix' => 'permit_empty',
            'sex' => 'required',
            'purok' => 'required',
            'census_year' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = $this->UserId();

        $data = [
            'resident_id' => $userId,
            'firstname' => $this->request->getPost('firstname'),
            'middle_initial' => $this->request->getPost('middle_initial'),
            'lastname' => $this->request->getPost('lastname'),
            'suffix' => $this->request->getPost('suffix'),
            'sex' => $this->request->getPost('sex'),
            'purok' => $this->request->getPost('purok'),
            'census_year' => $this->request->getPost('census_year'),
        ];

        $user = new PopulationModel();
        $user->save($data);

        return redirect()->to('/admin/population')
            ->with('success', $this->request->getPost('firstname') . ' Added Successfully');
    }

    public function update()
    {
        $user = new PopulationModel();
        $id = $this->request->getPost('id');
        $validation = Services::validation();

        $rules = [
            'firstname' => 'required',
            'middle_initial' => 'permit_empty',
            'lastname' => 'required',
            'suffix' => 'permit_empty',
            'sex' => 'permit_empty',
            'purok' => 'required',
            'census_year' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $userFind = $user->where('id', $id)->first();
        if (!$userFind) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'middle_initial' => $this->request->getPost('middle_initial'),
            'lastname' => $this->request->getPost('lastname'),
            'sex' => $this->request->getPost('sex'),
            'purok' => $this->request->getPost('purok'),
        ];

        $user->update($id, $data);

        return redirect()->back()->with('success', $data['firstname'] . ' updated successfully!');
    }


    public function delete()
    {
        $user = new PopulationModel();
        $id = $this->request->getPost('id');
        $find = $user->where('is_deleted', 0)->where('id', $id)->first();

        if ($find) {
            $data['is_deleted'] = 1;
            $user->update($id, $data);
            return redirect()->back()->with('success', $find['firstname'] . ' Deleted Successfully');
        }

        return redirect()->back()->with('error', $find['firstname'] . ' already deleted');
    }

    public function UserId()
    {
        $prefix = date('Ym');
        $users = new PopulationModel();
        $lastUser = $users->like('resident_id', $prefix . '-', 'after')
            ->orderBy('resident_id', 'DESC')
            ->first();

        if ($lastUser) {
            $lastNumber = (int) substr($lastUser['resident_id'], -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = "0001";
        }

        return $prefix . '-' . $newNumber;
    }
}

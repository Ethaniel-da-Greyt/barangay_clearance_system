<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RequestsModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;

class RequestsController extends BaseController
{
    public function store()
    {
        try {
            $validation = Services::validation();

            $rules = [
                'request_type'      => 'required',
                'firstname'         => 'required',
                'middle_initial'    => 'permit_empty',
                'lastname'          => 'required',
                'suffix'            => 'permit_empty',
                'sex'               => 'required',
                'purok'             => 'required',
                'contact_no'        => 'required',
                'photo'             => 'permit_empty|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,2048]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $user_id = $this->request->getPost('user_id');
            $request_id = "REQ-" . uniqid();

            $path = FCPATH . 'uploads/avatar/' . $user_id . '/requirements/' . $request_id . '/';
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            $img = $this->request->getFile('photo');

            if ($img && $img->isValid() && !$img->hasMoved()) {
                $imgName = $img->getRandomName();
                $img->move($path, $imgName);
                $path_file = $path . $imgName;
            } else {
                $defaultPhoto = FCPATH . 'uploads/No_image.png';
                $imgName = 'No_image.png';
                $path_file = $path . $imgName;

                if (file_exists($defaultPhoto)) {
                    copy($defaultPhoto, $path . $imgName);
                }
            }


            $data = [
                'request_id' => $request_id,
                'request_type' => $this->request->getPost('request_type'),
                'firstname' => $this->request->getPost('firstname'),
                'middle_initial' => $this->request->getPost('middle_initial'),
                'lastname' => $this->request->getPost('lastname'),
                'suffix' => $this->request->getPost('suffix'),
                'sex' => $this->request->getPost('sex'),
                'purok' => $this->request->getPost('purok'),
                'contact_no' => $this->request->getPost('contact_no'),
                'photo' => $path_file,
            ];

            $user = new RequestsModel();
            $user->save($data);

            return redirect()->to('/admin/requests')
                ->with('success', $this->request->getPost('firstname') . ' Added Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update()
    {
        try {
            $model = new RequestsModel();
            $id = $this->request->getPost('id');
            $validation = Services::validation();

            $rules = [
                'request_type' => 'required',
                'firstname' => 'required',
                'middle_initial' => 'permit_empty',
                'lastname' => 'required',
                'suffix' => 'permit_empty',
                'sex' => 'permit_empty',
                'purok' => 'required',
                'contact_no' => 'required',
                'photo' => 'permit_empty',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }


            $findRequest = $model->where('id', $id)->first();
            if (!$findRequest) {
                return redirect()->back()->with('error', 'User not found.');
            }

            $data = [
                'request_type' => $this->request->getPost('firstname'),
                'firstname' => $this->request->getPost('firstname'),
                'middle_initial' => $this->request->getPost('middle_initial'),
                'lastname' => $this->request->getPost('lastname'),
                'suffix' => $this->request->getPost('suffix'),
                'sex' => $this->request->getPost('sex'),
                'purok' => $this->request->getPost('purok'),
                'contact_no' => $this->request->getPost('contact_no'),
                'photo' => $this->request->getPost('photo'),
            ];

            $model->update($id, $data);

            return redirect()->back()->with('success', $data['request_type'] . ' updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function delete()
    {
        try {
            $user = new RequestsModel();
            $id = $this->request->getPost('id');
            $find = $user->where('is_deleted', 0)->where('id', $id)->first();

            if ($find) {
                $data['is_deleted'] = 1;
                $user->update($id, $data);
                return redirect()->back()->with('success', $find['firstname'] . ' Deleted Successfully');
            }

            return redirect()->back()->with('error', $find['firstname'] . ' already deleted');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //Approve Requests
    public function approve()
    {
        try {
            $id = $this->request->getPost('id');

            $request = new RequestsModel();
            $request_find = $request->where('id', $id)
                ->where('is_deleted', 0)
                ->where('is_canceled', 0)
                ->first();
            $data = ['status' => 'approved'];
            $approve = $request->update($id, $data);

            if (!$approve) {
                return redirect()->back()->with('error', 'Failed to Approve the request');
            }
            return redirect()->back()->with('success', $request_find['request_id'] . ' Request Approved');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //Reject Request
    public function reject()
    {
        try {
            $id = $this->request->getPost('id');

            $request = new RequestsModel();
            $request_find = $request->where('id', $id)
                ->where('is_deleted', 0)
                ->where('is_canceled', 0)
                ->first();
            $data = ['status' => 'approved'];
            $approve = $request->update($id, $data);

            if (!$approve) {
                return redirect()->back()->with('error', 'Failed to Approve the request');
            }
            return redirect()->back()->with('success', $request_find['request_id'] . ' Request Rejected');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // public function request_id()
    // {
    //     $prefix = date('Ym');
    //     $users = new RequestsModel();
    //     $lastUser = $users->like('resident_id', $prefix . '-', 'after')
    //         ->orderBy('resident_id', 'DESC')
    //         ->first();

    //     if ($lastUser) {
    //         $lastNumber = (int) substr($lastUser['resident_id'], -4);
    //         $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    //     } else {
    //         $newNumber = "0001";
    //     }

    //     return $prefix . '-' . $newNumber;
    // }
}

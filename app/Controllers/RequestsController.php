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
            $model = new RequestsModel;
            $validation = Services::validation();

            $rules = [
                'request_type' => 'required',
                'firstname' => 'required',
                'middle_initial' => 'permit_empty',
                'lastname' => 'required',
                'suffix' => 'permit_empty',
                'sex' => 'required',
                'purok' => 'required',
                'contact_no' => 'required',
                'photo' => 'permit_empty|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png,image/webp]|max_size[photo,2048]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $today = date('Y-m-d');
            $requestor_id = session()->get('user_id');
            $request = $model->where('created_at >=', $today . ' 00:00:00')
                ->where('created_at <=', $today . ' 23:59:59')
                ->where('requestor_id', $requestor_id)
                ->countAllResults();
            if ($request >= 3) {
                return redirect()->back()->with('error', 'You have reached the maximum of 3 requests for today.');
            }

            $user_id = $requestor_id;
            $request_id = "REQ-" . uniqid();

            $uploadPath = 'uploads/avatar/' . $user_id . '/requirements/' . $request_id . '/';
            $fullPath = FCPATH . $uploadPath;

            if (!is_dir($fullPath)) {
                mkdir($fullPath, 0755, true);
            }

            $img = $this->request->getFile('photo');

            if ($img && $img->isValid() && !$img->hasMoved()) {
                $imgName = $img->getRandomName();
                $img->move($fullPath, $imgName);
                $photoPath = $uploadPath . $imgName;
            } else {

                $photoPath = 'uploads/No_image.png';
            }

            $data = [
                'request_id' => $request_id,
                'requestor_id' => $requestor_id,
                'request_type' => $this->request->getPost('request_type'),
                'firstname' => $this->request->getPost('firstname'),
                'middle_initial' => $this->request->getPost('middle_initial'),
                'lastname' => $this->request->getPost('lastname'),
                'suffix' => $this->request->getPost('suffix'),
                'sex' => $this->request->getPost('sex'),
                'purok' => $this->request->getPost('purok'),
                'contact_no' => $this->request->getPost('contact_no'),
                'photo' => $photoPath,
            ];

            $model->save($data);

            return redirect()->to('/resident')
                ->with('success', $request_id . ' Requested Successfully');
        } catch (Exception $e) {
            return redirect()->to('/resident')->with('error', $e->getMessage());
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
                'photo' => 'permit_empty|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png,image/webp]|max_size[photo,2048]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }


            $findRequest = $model->find($id);
            if (!$findRequest) {
                return redirect()->back()->with('error', 'Request not found.');
            }


            $img = $this->request->getFile('photo');
            $photoPath = $findRequest['photo'];

            if ($img && $img->isValid() && !$img->hasMoved()) {
                if ($photoPath && file_exists(FCPATH . $photoPath) && $photoPath !== 'uploads/No_image.png') {
                    unlink(FCPATH . $photoPath);
                }

                $user_id = $findRequest['requestor_id'] ?? session()->get('user_id');
                $request_id = $findRequest['request_id'];
                $uploadPath = 'uploads/avatar/' . $user_id . '/requirements/' . $request_id . '/';
                $fullPath = FCPATH . $uploadPath;
                if (!is_dir($fullPath)) {
                    mkdir($fullPath, 0755, true);
                }

                $imgName = $img->getRandomName();
                $img->move($fullPath, $imgName);
                $photoPath = $uploadPath . $imgName;
            }

            $data = [
                'request_type' => $this->request->getPost('request_type'),
                'firstname' => $this->request->getPost('firstname'),
                'middle_initial' => $this->request->getPost('middle_initial'),
                'lastname' => $this->request->getPost('lastname'),
                'suffix' => $this->request->getPost('suffix'),
                'sex' => $this->request->getPost('sex'),
                'purok' => $this->request->getPost('purok'),
                'contact_no' => $this->request->getPost('contact_no'),
                'photo' => $photoPath,
            ];

            $model->update($id, $data);

            return redirect()->to('/resident')->with('success', $findRequest['request_id'] . ' updated successfully!');
        } catch (Exception $e) {
            return redirect()->to('/resident')->with('error', $e->getMessage());
        }
    }

    //RESIDENT ACTION
    public function reSubmit()
    {
        try {
            $model = new RequestsModel();
            $id = $this->request->getPost('id');

            $request = $model->where('is_deleted', 0)
                ->where('is_canceled', 1)
                ->where('id', $id);
            if (!$request) {
                return redirect()->to('/resident')->with('error', 'Unable to submit your request');
            }
            $data['is_canceled'] = 0;
            $request->update($id, $data);

            return redirect()->to('/resident')->with('success', 'You Successfully Resubmit your request');
        } catch (Exception $e) {
            return redirect()->to('/resident')->with('error', $e->getMessage());
        }
    }

    //RESIDENT ACTION
    public function cancel()
    {
        try {
            $request = new RequestsModel();
            $id = $this->request->getPost('id');
            $find = $request->where('is_deleted', 0)->where('id', $id)->first();

            if (!$find) {
                return redirect()->back()->with('error', $find['request_id'] . ' already Canceled');
            }
            $data['is_canceled'] = 1;
            $request->update($id, $data);
            return redirect()->to('/resident')->with('success', $find['request_type'] . ' Canceled Successfully');

        } catch (Exception $e) {
            return redirect()->to('/resident')->with('error', $e->getMessage());
        }
    }

    // Approve Requests ADMIN
    public function approve()
    {
        try {
            $id = $this->request->getPost('id');

            $request = new RequestsModel();
            $request_find = $request->where('id', $id)
                ->where('is_deleted', 0)
                ->where('is_canceled', 0)
                ->first();

            if (!$request_find) {
                return redirect()->back()->with('error', 'Request not found.');
            }

            $data = [
                'status' => 'approved',
                'notified' => 0 // mark as not yet notified for resident
            ];

            $approve = $request->update($id, $data);

            if (!$approve) {
                return redirect()->back()->with('error', 'Failed to Approve the request');
            }

            return redirect()->to('/admin/requests')->with('success', $request_find['request_id'] . ' Request Approved');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function claim()
    {
        try {
            $reqId = $this->request->getPost('id');
            $request = new RequestsModel();

            $find = $request->where('id', $reqId)
                ->where('status', 'approved')
                ->where('is_deleted', 0)
                ->find();
            if (!$find) {
                return redirect()->back()->with('error', 'Unable to find the request');
            }
            $data = [
                'status' => 'claimed'
            ];
            $request->update($reqId, $data);

            return redirect()->to('admin/requests')->with('success', 'Request Claimed');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());

        }
    }


    //Reject Request ADMIN
    public function reject()
    {
        try {
            $id = $this->request->getPost('id');

            $request = new RequestsModel();
            $request_find = $request->where('id', $id)
                ->where('is_deleted', 0)
                ->where('is_canceled', 0)
                ->first();

            if (!$request_find) {
                return redirect()->back()->with('error', 'Request not found.');
            }

            $data = [
                'status' => 'rejected',
                'notified' => 0
            ];

            $reject = $request->update($id, $data);

            if (!$reject) {
                return redirect()->back()->with('error', 'Failed to Reject the request');
            }

            return redirect()->to('/admin/requests')->with('success', $request_find['request_id'] . ' Request Rejected');
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

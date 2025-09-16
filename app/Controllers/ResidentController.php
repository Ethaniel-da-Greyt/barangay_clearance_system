<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DocumentModel;
use App\Models\RegisterUserModel;
use App\Models\RequestsModel;
use CodeIgniter\HTTP\ResponseInterface;

class ResidentController extends BaseController
{
    public function user()
    {
        $docs = new DocumentModel();
        $model = new RequestsModel();

        $document = $this->request->getGet('document');
        $search = $this->request->getGet('search');


        $query = $model->where('is_deleted', 0);



        if (!empty($document)) {
            $query->where('request_type', $document);
        }


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
        $session = session();
        $requests = $model->where('requestor_id', $session->get('user_id'))->orderBy('created_at', 'DESC')->findAll();

        return view('user/user', ['document' => $docs, 'requests' => $requests]);
    }

    public function profile()
    {
        $model = new RegisterUserModel();
        $user_id = session()->get('user_id');
        $user = $model->where('user_id', $user_id)->where('is_deleted', 0)->first();
        if (!$user) {
            return redirect()->to('/login')->with('error', 'You must Login First');
        }

        return view('user/profile', ['user' => $user]);
    }

    public function updateProfile()
    {
        $user = new RegisterUserModel();
        $id = $this->request->getPost('id');

        $rules = [
            'firstname' => 'required',
            'middle_initial' => 'permit_empty',
            'lastname' => 'required',
            'sex' => 'permit_empty',
            'purok' => 'required',
            'password' => 'permit_empty',
            'new_password' => 'permit_empty',
            'username' => "permit_empty|is_unique[users.username,id,{$id}]",
            'photo' => 'permit_empty|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userFind = $user->where('id', $id)->first();
        if (!$userFind) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $userId = $userFind['user_id'];
        $uploadPath = 'uploads/avatar/' . $userId . '/';
        $fullPath = FCPATH . $uploadPath;

        if (!is_dir($fullPath)) {
            mkdir($fullPath, 0777, true);
        }

        $img = $this->request->getFile('photo');
        $imgPath = $userFind['photo'];

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move($fullPath, $imgName);
            $newPath = $uploadPath . $imgName;

            // delete old photo if it exists and is not the same as new one
            if (!empty($imgPath) && file_exists(FCPATH . $imgPath)) {
                unlink(FCPATH . $imgPath);
            }

            $imgPath = $newPath;
        }

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'middle_initial' => $this->request->getPost('middle_initial'),
            'lastname' => $this->request->getPost('lastname'),
            'sex' => $this->request->getPost('sex'),
            'purok' => $this->request->getPost('purok'),
            'username' => $this->request->getPost('username'),
            'photo' => $imgPath,
        ];
        $password = $this->request->getPost('password');
        $new_password = $this->request->getPost('new_password');

        if(!password_verify($password, $userFind['password']))
        {
            return redirect()->back()->with('error', 'Incorrect Old Password');
        }

        $data['password'] = password_hash($new_password, PASSWORD_DEFAULT);

        $user->update($id, $data);

        return redirect()->back()->with('success', $data['firstname'] . ' updated successfully!');
    }


    public function checkNotifications()
    {
        $userId = session()->get('user_id');
        $requestsModel = new RequestsModel();
        $document = new DocumentModel();

        $requests = $requestsModel
            ->where('requestor_id', $userId)
            ->whereIn('status', ['approved', 'rejected'])
            ->where('notified', 0)
            ->findAll();

        // Mark them as notified so they won’t notified again
        foreach ($requests as $req) {
            $requestsModel->update($req['id'], ['notified' => 1]);
        }

        return $this->response->setJSON($requests);
    }
}

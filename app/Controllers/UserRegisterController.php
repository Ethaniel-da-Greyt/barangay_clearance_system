<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegisterUserModel;
use Config\Services;
use CodeIgniter\HTTP\ResponseInterface;

class UserRegisterController extends BaseController
{
    public function update()
    {
        $user = new RegisterUserModel();
        $id = $this->request->getPost('id');
        $validation = Services::validation();

        $rules = [
            'firstname' => 'required',
            'middle_initial' => 'permit_empty',
            'lastname' => 'required',
            'sex' => 'permit_empty',
            'purok' => 'required',
            'username' => "permit_empty|is_unique[users.username,id,{$id}]",
            'role' => 'required',
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
            'role' => $this->request->getPost('role'),
            'photo' => $imgPath,
        ];

        $user->update($id, $data);

        return redirect()->back()->with('success', $data['firstname'] . ' updated successfully!');
    }


    public function store()
    {
        $validation = Services::validation();

        $rules = [
            'firstname' => 'required',
            'middle_initial' => 'permit_empty',
            'lastname' => 'required',
            'sex' => 'required',
            'purok' => 'required',
            'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'role' => 'permit_empty',
            'photo' => 'permit_empty|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[photo,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = $this->UserId();

        $uploadPath = 'uploads/avatar/' . $userId . '/';
        $fullPath = FCPATH . $uploadPath;

        if (!is_dir($fullPath)) {
            mkdir($fullPath, 0777, true);
        }

        $img = $this->request->getFile('photo');

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
            'user_id' => $userId,
            'firstname' => $this->request->getPost('firstname'),
            'middle_initial' => $this->request->getPost('middle_initial'),
            'lastname' => $this->request->getPost('lastname'),
            'sex' => $this->request->getPost('sex'),
            'purok' => $this->request->getPost('purok'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'photo' => $imgPath,
        ];

        $user = new RegisterUserModel();
        $user->save($data);

        return redirect()->to('/admin/residents')
            ->with('success', $this->request->getPost('firstname') . ' Added Successfully');
    }


    public function delete()
    {
        $user = new RegisterUserModel();
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
        $users = new RegisterUserModel();
        $lastUser = $users->like('user_id', $prefix . '-', 'after')
            ->orderBy('user_id', 'DESC')
            ->first();

        if ($lastUser) {
            $lastNumber = (int) substr($lastUser['user_id'], -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = "0001";
        }

        return $prefix . '-' . $newNumber;
    }

    public function defaultPassword()
    {
        try {
            $id = $this->request->getPost('id');

            $user = new RegisterUserModel();


            $data['password'] = DEFAULT_PASSWORD;

            $user->update($id, $data);

            return redirect()->back()->with('success', 'Default Password Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

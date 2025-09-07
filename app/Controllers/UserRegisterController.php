<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegisterUserModel;
use Config\Services;
use CodeIgniter\HTTP\ResponseInterface;

class UserRegisterController extends BaseController
{
    public function update($id)
    {
        $user = new RegisterUserModel();
        $validation = Services::validation();

        $rules = [
            'firstname' => 'required',
            'middle_initial' => 'permit_empty',
            'lastname' => 'required',
            'photo' => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('photo');

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move('uploads/', $imgName);
            $data['photo'] = $imgName; // add photo to update data
        }

        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'middle_initial' => $this->request->getPost('middle_initial'),
            'lastname' => $this->request->getPost('lastname'),
        ];

        $user->update($id, $data);
        $find = $user->where('is_deleted', 0)->find($id);
        return redirect()->back()->with('success', $find->firstname . ' Updated Successfully');
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

        $path = FCPATH . 'uploads/avatar/' . $userId . '/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $img = $this->request->getFile('photo');

        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move($path, $imgName);
        } else {
            $defaultPhoto = FCPATH . 'uploads/no_photo.jpg';
            $imgName = 'no_photo.jpg';

            if (file_exists($defaultPhoto)) {
                copy($defaultPhoto, $path . $imgName);
            }
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
            'photo' => $imgName,
        ];

        $user = new RegisterUserModel();
        $user->save($data);

        return redirect()->to('/admin/residence')
            ->with('success', $this->request->getPost('firstname') . ' Added Successfully');
    }


    public function delete($id)
    {
        $user = new RegisterUserModel();
        $find = $user->where('is_deleted', 0)->where('id', $id)->first();

        if (!$find) {
            $data['is_deleted'] = 1;
            $user->update($id, $data);
            return redirect()->back()->with('success', $find->firstname . ' Deleted Successfully');
        }

        return redirect()->back()->with('error', $find->firstname . ' already deleted');
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
}

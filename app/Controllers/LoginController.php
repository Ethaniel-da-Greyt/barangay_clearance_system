<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegisterUserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Validation\Rules;
use Config\Services;

class LoginController extends BaseController
{
    public function index()
    {
        return view('index/login');
    }

    public function login()
    {
        $validation = Services::validation();

        $rules = [
            'username' => 'required|max_length[30]',
            'password' => 'required|max_length[100]|min_length[5]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new RegisterUserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                if ($user['role'] == 'admin') {
                    session()->set([
                        'user' => $user,
                        'user_id' => $user['user_id'],
                        'role' => 'admin',
                        'isLoggedIn' => true
                    ]);
                    return redirect()->to('/admin');
                } elseif ($user['role'] == 'resident') {
                    session()->set([
                        'user_id' => $user['user_id'],
                        'username' => $user['username'], 
                        'role' => 'resident',
                        'isLoggedIn' => true
                    ]);
                    return redirect()->to('/resident');
                }else{
                    return redirect()->to('/login')->with('error','Unauthorized');
                }
            }else{
                return redirect()->to('/login')->with('error','Incorrect Password');
            }
        }else{
            return redirect()->to('/login')->with('error','Username Unrecognized');
        }

    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}

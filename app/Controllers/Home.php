<?php

namespace App\Controllers;

use App\Models\RegisterUserModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('admin/dashboard');
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
}

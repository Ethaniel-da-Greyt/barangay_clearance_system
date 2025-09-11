<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ResidentController extends BaseController
{
    public function user()
    {
        return view('user/user');
    }
}

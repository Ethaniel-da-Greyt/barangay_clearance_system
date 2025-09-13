<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DocumentModel;
use App\Models\RequestsModel;
use CodeIgniter\HTTP\ResponseInterface;

class ResidentController extends BaseController
{
    public function user()
    {
        $docs = new DocumentModel();
        $req = new RequestsModel();
        $session = session();
        $requests = $req->where('requestor_id', $session->get('user_id'))->findAll(); 

        return view('user/user', ['document' => $docs, 'requests' => $requests]);
    }
}

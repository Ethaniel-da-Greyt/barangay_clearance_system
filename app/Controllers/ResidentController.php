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
        $requests = $req->where('requestor_id', $session->get('user_id'))->orderBy('created_at', 'DESC')->findAll(); 

        return view('user/user', ['document' => $docs, 'requests' => $requests]);
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

        // Mark them as notified so they won’t fire again
        foreach ($requests as $req) {
            $requestsModel->update($req['id'], ['notified' => 1]);
        }

        return $this->response->setJSON($requests);
    }
}

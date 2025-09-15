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

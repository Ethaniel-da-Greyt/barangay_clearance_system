<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EspSystem;
use App\Models\FireCaseModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class RegisterESP extends BaseController
{
    use ResponseTrait;
    protected $format = 'json';
    public function registerESP()
    {
        $model = new EspSystem();

        // Receive JSON data as associative array
        $data = $this->request->getJSON(true);

        // Extract ESP ID from JSON
        $id = $data['esp_id'] ?? null;

        if (!$id) {
            return $this->respond([
                'status' => 400,
                'message' => 'esp_id is required'
            ], 400);
        }

        // Check if already registered
        $system = $model->where('esp_id', $id)
            ->where('is_deleted', 0)
            ->first();

        if ($system) {
            return $this->respond([
                'status' => 401,
                'esp_id' => $id,
                'message' => 'Registered Already'
            ], 401);
        }

        // Insert new record
        $model->insert([
            'esp_id' => $id,
            'is_deleted' => 0
        ]);

        return $this->respond([
            'status' => 200,
            'esp_id' => $id,
            'message' => 'Registered Successfully'
        ], 200);
    }

    // public function registerESP()
    // {
    //     $data = $this->request->getJSON(true); // Get JSON body as associative array
    //     $model = new EspSystem(); // Model for devices

    //     // Validate input
    //     if (empty($data['esp_id'])) {
    //         return $this->response
    //             ->setStatusCode(400)
    //             ->setJSON([
    //                 'status' => 'error',
    //                 'message' => 'Missing chip_id'
    //             ]);
    //     }

    //     // Check if already registered
    //     $existing = $model->where('esp_id', $data['esp_id'])->first();

    //     if ($existing) {
    //         return $this->response->setJSON([
    //             'status' => 'success',
    //             'message' => 'Device already registered',
    //             'esp_id' => $data['esp_id']
    //         ]);
    //     }

    //     // Register new device
    //     $model->insert([
    //         'esp_id' => $data['esp_id']
    //     ]);

    //     return $this->response->setJSON([
    //         'status' => 'success',
    //         'message' => 'Device registered successfully',
    //         'esp_id' => $data['esp_id']
    //     ]);
    // }

    public function updateESP()
    {
        $model = new EspSystem();
        $id = $this->request->getPost('id');
        $getSystem = $model->where('id', $id)->where('is_deleted', 0)->first();

        $data = [
            'address' => $this->request->getPost('address'),
            'household' => $this->request->getPost('household'),
        ];

        $model->update($id, $data);

        return redirect()->back()
            ->with('success', 'System Updated Successfully');
    }

    public function makeAlert()
    {
        date_default_timezone_set('Asia/Manila'); // Ensure correct local time

        $data = $this->request->getJSON(true);
        $id = $data['esp_id'];
        $status = $data['status'];

        if (empty($id)) {
            return $this->response->setJSON([
                'status' => 401,
                'error' => 'Chip ID is empty'
            ]);
        }

        $SystemModel = new EspSystem();
        $system = $SystemModel->where('esp_id', $id)->first();

        if (!$system) {
            return $this->response->setJSON([
                'status' => 404,
                'error' => 'ESP ID not found.'
            ]);
        }

        $model = new FireCaseModel();

        // Check if there is already a recent "warning" alert for the same ESP
        $checkRecord = $model->where('household', $system['household'])
            ->where('status', $status)
            ->where('exact_location', $system['address'])
            ->where('is_deleted', 0)
            ->where('DATE(date_occurrence)', date('Y-m-d'))
            ->first();

        if ($checkRecord) {
            return $this->response->setJSON([
                'status' => 400,
                'error' => 'A fire alert for this ESP is already active today.'
            ]);
        }

        $insert = [
            'case_id' => $this->FireCaseId(),
            'date_occurrence' => date('Y-m-d H:i:s'),
            'date_report' => date('Y-m-d H:i:s'),
            'exact_location' => $system['address'],
            'cause_of_fire' => null,
            'affected_households' => null,
            'household' => $system['household'],
            'type_of_occupancy' => null,
            'casualties' => null,
            'affected_individuals' => null,
            'status' => $status,
        ];

        $model->insert($insert);

        return $this->response->setJSON([
            'status' => 200,
            'message' => 'Alert successfully created.',
            'address' => $system['address'],
            'household' => $system['household'],
            'alert_status' => $status
        ]);
    }


    public function FireCaseId()
    {
        date_default_timezone_set('Asia/Manila');

        $prefix = date('Ym');
        $fireCases = new FireCaseModel();

        $lastCase = $fireCases
            ->like('case_id', 'FC-' . $prefix . '-', 'after')
            ->orderBy('case_id', 'DESC')
            ->first();

        if ($lastCase) {
            $lastNumber = (int) substr($lastCase['case_id'], -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return 'FC-' . $prefix . '-' . $newNumber;
    }


}

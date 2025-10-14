<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RequestsModel;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfMakerController extends BaseController
{
    public function index()
    {
        try {
            $filter = $this->request->getGet('month');
            [$year, $month] = explode('-', $filter);
            $request = new RequestsModel();

            $query = $request->where('status', 'claimed')
                                 ->where('is_deleted', 0)
                                 ->where('YEAR(created_at)', $year)
                                 ->where('MONTH(created_at)', $month)->findAll();

            
            $html = view('admin/pdf/pdf_layout', ['requests' => $query, 'month'=>$filter]);

            $options = new Options();
            $options->set('isRemoteEnabled', true); //To allow external images or CSS
            
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            return $this->response->setHeader('Content-Type', 'application/pdf')->setBody($dompdf->output());


        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}

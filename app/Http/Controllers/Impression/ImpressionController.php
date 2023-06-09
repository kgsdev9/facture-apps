<?php

namespace App\Http\Controllers\Impression;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Client;
use App\Models\Commande ;
use Codedge\Fpdf\Fpdf\Fpdf;

class ImpressionController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
         $this->fpdf = new Fpdf;
    }






    public function rapportCommande() {

        $data = Commande::orderByDesc('created_at')->get();
        $pdf = Pdf::loadView('impression.rapportcommande',  [
            'data' =>$data

        ])->setOptions(['defaultFont' => 'sans-serif']);
           return $pdf->download('RapportCommande.pdf');

    }


    public function recu_impression($id)  {
        $order = Commande::find($id);

         $pdf = Pdf::loadView('impression.commande',  [
            'orders' =>$order

        ])->setOptions(['defaultFont' => 'sans-serif']);
           return $pdf->download('commande.pdf');

    }


    public function fpdftest()  {
         $this->fpdf->SetFont('Arial', 'B', 15);
        $this->fpdf->AddPage("L", ['200', '400']);
        $this->fpdf->Text(10, 10, "STEPHANE GUY ");       

        $this->fpdf->Output();

        exit;
    }




}

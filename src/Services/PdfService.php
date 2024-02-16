<?php

namespace App\Services;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService{
    private $dumppdf;
    public function __construct(){ $this->dumppdf = new Dompdf();
    $pdfoption = new Options();
    $pdfoption->set('defaultFont','Garamond');
    $this->dumppdf->setOptions($pdfoption);
    }
    
    public function showPDF($html){
        $this->dumppdf->loadHtml($html);
        $this->dumppdf->render();
        $this->dumppdf->stream('detaills.pdf',['Attachement' => false ]);
    
    }
    public function generateBinaryPDF($html){
        $this->dumppdf->loadHtml($html);
        $this->dumppdf->render();
        $this->dumppdf->output();



    }
}


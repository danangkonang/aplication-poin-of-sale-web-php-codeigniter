<?php
    // $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    $width = 30;  
    $height = 55; 
    $pageLayout = array($width, $height); //  or array($height, $width) 
    // $width = 175;  
// $height = 266; 
    $pdf = new Pdf('p', 'pt', $pageLayout, true, 'UTF-8', false);
    // $pdf = new Pdf('P', 'mm', '[57, 30]', true, 'UTF-8', false);
    $pdf->SetTitle('Nota');
    $pdf->SetTopMargin(10);
    $pdf->setFooterMargin(10);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->AddPage();
    $pdf->Write(5, 'Contoh Laporan PDF dengan CodeIgniter + tcpdf');
    $pdf->Output('contoh1.pdf', 'I');




//     $pdf = new CUSTOMPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
// //Add a custom size  
// $width = 175;  
// $height = 266; 
// $orientation = ($height>$width) ? 'P' : 'L';  
// $pdf->addFormat("custom", $width, $height);  
// $pdf->reFormat("custom", $orientation);  
?>
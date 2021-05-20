<?php
  $width = 30;  
  $height = 55; 
  $pageLayout = array($width, $height); //  or array($height, $width) 
  $pdf = new Pdf('p', 'pt', $pageLayout, true, 'UTF-8', false);
  $pdf->SetTitle('Nota');
  $pdf->SetTopMargin(10);
  $pdf->setFooterMargin(10);
  $pdf->SetAutoPageBreak(true);
  $pdf->SetAuthor('Author');
  $pdf->SetDisplayMode('real', 'default');
  $pdf->AddPage();
  $pdf->Write(5, 'Contoh Laporan PDF dengan CodeIgniter + tcpdf');
  $pdf->Output('contoh1.pdf', 'I');

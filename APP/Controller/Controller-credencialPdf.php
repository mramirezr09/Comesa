<?php
  require_once('fpdf/fpdf.php');
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',8);
  // $pdf->Cell(40,10,'Hola, Mundo',C,R);
  $pdf->Cell(120,7,'No se han encontrado registros para mostrar',0,0,'C');
  $pdf->Output();
?>

?>

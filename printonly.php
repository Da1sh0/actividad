<?php
require('fpdf.php');
include "conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query);
}

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'DATOS GUARDADOS', 0, 1, 'C');
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página : ') . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

$query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id = '$id'");
$result = mysqli_num_rows($query);

if ($result > 0) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, 10, 'ID', 1, 0, 'L', 0);
    $pdf->Cell(60, 10, 'Nombre', 1, 0, 'L', 0);
    $pdf->Cell(70, 10, 'Correo Electronico', 1, 0, 'L', 0);
    $pdf->Cell(40, 10, 'Telefono', 1, 1, 'L', 0);


    
    for ($i = 0; $i < $result; $i++) {
        $data = mysqli_fetch_assoc($query);
        $pdf->Cell(10, 10, $data['id'], 1, 0, 'L', 0);
        $pdf->Cell(60, 10, $data['nombre'], 1, 0, 'L', 0);
        $pdf->Cell(70, 10, $data['correo'], 1, 0, 'L', 0);
        $pdf->Cell(40, 10, $data['telefono'], 1, 0, 'L', 0);
    }
    
}

$pdf->Output();
exit; // Detiene la ejecución del script después de enviar el PDF
?>

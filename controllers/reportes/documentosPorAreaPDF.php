<?php
require('../../plugins/fpdf/fpdf.php');
date_default_timezone_set('America/Lima');

class PDF extends FPDF{

    private $fechaActual;
    private $horaActual;

    function __construct($fecha, $hora) {
        parent::__construct();
        $this->fechaActual = $fecha;
        $this->horaActual = $hora;
    }

    function Header(){
        $this->SetFont('Arial','',10);
        $this->SetXY(175, 2);
        $this->Cell(35, 5,'Fecha: ' .$this->fechaActual, 0, 1, 'L', 0);
        $this->SetX(175);
        $this->Cell(35, 5,'Hora:  '.$this->horaActual, 0, 0, 'L', 0);

        $this->SetFont('Arial','',20);
        $this->Image('../../assets/logo.png', 10, 8, 40);
        $this->SetXY(60, 20);

        $this->Cell(100, 8, 'Municipalidad Distrital de La Esperanza', 0, 0, 'C', 0);

        $this->SetFont('Arial','',12);
        $this->Ln(15);
        $this->SetX(60);
        $this->Cell(100, 8, mb_convert_encoding('Reporte de Documentos por Áreas','ISO-8859-1', 'UTF-8'), 0, 1, 'C', 0);
        $this->Ln(10);
    }


    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','B',8);
        $this->Cell(0,10,mb_convert_encoding('Página ','ISO-8859-1', 'UTF-8').$this->PageNo().'/{nb}',0,0,'C');
    }

    protected $widths;
    protected $aligns;

    function SetWidths($w){
        // Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a){
        // Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data, $setX){
        // Calculate the height of the row
        $nb = 0;
        for($i=0;$i<count($data);$i++)
            $nb = max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h = 5*$nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h, $setX);
        // Draw the cells of the row
        for($i=0;$i<count($data);$i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x,$y,$w,$h, 'DF');
            // Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            // Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        // Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h, $setX){
        // If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger){
            $this->AddPage($this->CurOrientation);
            $this->SetX($setX);

            $this->SetFont('Arial','B',10);
            $this->Cell(17, 8, 'Nro Doc', 1, 0, 'C', 0);
            $this->Cell(25, 8, 'Tipo Doc', 1, 0, 'C', 0);
            $this->Cell(38, 8, 'Asunto', 1, 0, 'C', 0);
            $this->Cell(15, 8, 'Folios', 1, 0, 'C', 0);
            $this->Cell(30, 8, 'Usuario', 1, 0, 'C', 0);
            $this->Cell(30, 8, mb_convert_encoding('Área','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
            $this->Cell(25, 8, 'Estado Doc', 1, 0, 'C', 0);
            $this->Cell(25, 8, mb_convert_encoding('Estado Envío','ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);

            $this->SetFont('Arial','',10);

        }

        if ($setX==100){
            $this->SetX(100);
        }else{
            $this->SetX($setX);
        }
    }

    function NbLines($w, $txt){
        // Compute the number of lines a MultiCell of width w will take
        if(!isset($this->CurrentFont))
            $this->Error('No font has been set');
        $cw = $this->CurrentFont['cw'];
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
        $s = str_replace("\r",'',(string)$txt);
        $nb = strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i<$nb)
        {
            $c = $s[$i];
            if($c=="\n")
            {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep = $i;
            $l += $cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i = $sep+1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
}


// Obtener la fecha y hora actual
$fechaActual = date('Y-m-d');
$horaActual = date('H:i');
$pdf = new PDF($fechaActual, $horaActual);
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetX(3);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(17, 8, 'Nro Doc', 1, 0, 'C', 0);
$pdf->Cell(25, 8, 'Tipo Doc', 1, 0, 'C', 0);
$pdf->Cell(38, 8, 'Asunto', 1, 0, 'C', 0);
$pdf->Cell(15, 8, 'Folios', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Usuario', 1, 0, 'C', 0);
$pdf->Cell(30, 8, mb_convert_encoding('Área','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->Cell(25, 8, 'Estado Doc', 1, 0, 'C', 0);
$pdf->Cell(25, 8, mb_convert_encoding('Estado Envío','ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);


$pdf->SetFillColor(233, 229, 235);
//$pdf->SetDrawColor(61, 61, 61);
$pdf->SetFont('Arial','',10);

$pdf->SetWidths(array(17, 25, 38, 15, 30, 30, 25, 25));


session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";

$documentoModel = new Documento();

$response = [];

$codArea = null;
$numDocumento = null;

if ($_SESSION['user']['rol'] == 'administrador') {
    if (isset($_POST['area']) && isset($_POST['numDocumento']) && $_POST['area'] != 0) {
        $codArea = $_POST['area'];
        $numDocumento = $_POST['numDocumento'];
    } else if (isset($_POST['area']) && isset($_POST['numDocumento']) && $_POST['area'] == 0) {
        $numDocumento = $_POST['numDocumento'];
    } else {
        $codArea = null;
        $numDocumento = null;
    }
} else if ($_SESSION['user']['rol'] == 'usuario') {
    $codArea = $_SESSION['user']['codArea'];
    if (isset($_POST['numDocumento'])) {
        $numDocumento = $_POST['numDocumento'];
    }
}

if ($codArea && $numDocumento) {
    $response = $documentoModel->reportesPorArea((int)$codArea, $numDocumento, null, null);
} else if ($codArea) {
    $response = $documentoModel->reportesPorArea((int)$codArea, null, null, null);
} else if ($numDocumento) {
    $response = $documentoModel->reportesPorArea(null, $numDocumento, null, null);
} else {
    $response = $documentoModel->reportesPorArea(null, null, null, null);
}

foreach ($response['data'] as $documento) {
    $pdf->Row(array(
        $documento['NumDocumento'],
        mb_convert_encoding( $documento['tipoDocumento'],'ISO-8859-1', 'UTF-8'),
        mb_convert_encoding($documento['asunto'],'ISO-8859-1', 'UTF-8'),
        $documento['folios'],
        mb_convert_encoding($documento['usuario'],'ISO-8859-1', 'UTF-8'),
        mb_convert_encoding($documento['area'],'ISO-8859-1', 'UTF-8'),
        $documento['estadoDocumento'] == 'a' ? 'En seguimiento' : 'Seguimiento Finalizado',
        $documento['estadoRecepcion'] == 'a' ? 'Recepcionado' : mb_convert_encoding('Pendiente de Recepción','ISO-8859-1', 'UTF-8')
    ), 3);
}


//// Configurar las cabeceras para la descarga del PDF
//header('Content-Type: application/pdf');
//
//// Nombre del archivo
//$filename = 'documentosPorArea.pdf';
//header('Content-Disposition: inline; filename="' . $filename . '"');

// Enviar el PDF al navegador
$pdf->Output();
?>

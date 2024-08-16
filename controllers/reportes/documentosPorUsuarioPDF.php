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
//        $this->SetXY(1, 2);
//        $this->Cell(35, 5,'Sistema de Seguimiento de Documentos Internos y Externos', 0, 1, 'L', 0);

        $this->SetXY(260, 2);
        $this->Cell(35, 5,'Fecha: ' .$this->fechaActual, 0, 1, 'L', 0);
        $this->SetX(260);
        $this->Cell(35, 5,'Hora  :  '.$this->horaActual, 0, 0, 'L', 0);

        $this->SetFont('Arial','B',20);
        $this->Image('../../assets/logo.png', 5, 2, 35);
        $this->SetXY(80, 12);

        $this->Cell(150, 15, mb_convert_encoding('REPORTE DE DOCUMENTOS','ISO-8859-1', 'UTF-8'), 0, 1, 'C', 0);
        $this->Ln(10);

        $this->SetFont('Arial','',12);
        $this->SetX(10);

        if ($_POST['usuarioText'] != 'Seleccionar' && $_POST['numDocumento'] != ''){
            $this->SetX(50);
            $this->Cell(130, 8, mb_convert_encoding('Usuario: ' .$_POST['usuarioText'], 'ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
            $this->Cell(100, 8, mb_convert_encoding('Número documento: '.$_POST['numDocumento'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
        }

        if ($_POST['usuarioText'] != 'Seleccionar' && $_POST['numDocumento'] == ''){
            $this->Cell(130, 8, mb_convert_encoding('Usuario: ' . (($_POST['usuarioText'] == 'Seleccionar') ? 'Todos' : $_POST['usuarioText']), 'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
        }

        if ($_POST['numDocumento'] != '' && $_POST['usuarioText'] == 'Seleccionar'){
            $this->Cell(100, 8, mb_convert_encoding('Número documento: '.$_POST['numDocumento'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
        }

            $this->Ln(5);
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

            if ($_POST['usuarioText'] == 'Seleccionar') {
                $this->Cell(30, 8, 'Nro Doc', 1, 0, 'C', 0);
                $this->Cell(30, 8, 'Tipo Doc', 1, 0, 'C', 0);
                $this->Cell(50, 8, 'Asunto', 1, 0, 'C', 0);
                $this->Cell(15, 8, 'Folios', 1, 0, 'C', 0);
                $this->Cell(40, 8, 'Usuario', 1, 0, 'C', 0);
                $this->Cell(40, 8, mb_convert_encoding('Área','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
                $this->Cell(35, 8, 'Estado Doc', 1, 0, 'C', 0);
                $this->Cell(35, 8, mb_convert_encoding('Estado Envío','ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
            }else if ($_POST['usuarioText'] != 'Seleccionar'){
                $this->Cell(30, 8, 'Nro Doc', 1, 0, 'C', 0);
                $this->Cell(30, 8, 'Tipo Doc', 1, 0, 'C', 0);
                $this->Cell(70, 8, 'Asunto', 1, 0, 'C', 0);
                $this->Cell(15, 8, 'Folios', 1, 0, 'C', 0);
                $this->Cell(50, 8, mb_convert_encoding('Área','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
                $this->Cell(40, 8, 'Estado Doc', 1, 0, 'C', 0);
                $this->Cell(45, 8, mb_convert_encoding('Estado Envío','ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
            }



            $this->SetFont('Arial','',9);

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
$fechaActual = date('d/m/Y');
$horaActual = date('H:i');
$pdf = new PDF($fechaActual, $horaActual);
$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->SetAutoPageBreak(true,20);
$pdf->SetX(10);
$pdf->SetFont('Arial','B',10);

if ($_POST['usuarioText'] != 'Seleccionar' && $_POST['numDocumento'] != ''){
    $pdf->Cell(40, 8, 'Tipo Documento', 1, 0, 'C', 0);
    $pdf->Cell(70, 8, 'Asunto', 1, 0, 'C', 0);
    $pdf->Cell(15, 8, 'Folios', 1, 0, 'C', 0);
    $pdf->Cell(60, 8, mb_convert_encoding('Área','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(45, 8, 'Estado Documento', 1, 0, 'C', 0);
    $pdf->Cell(45, 8, mb_convert_encoding('Estado Envío','ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
} else if ($_POST['usuarioText'] == 'Seleccionar' && $_POST['numDocumento'] != '') {
    $pdf->Cell(30, 8, 'Tipo Doc', 1, 0, 'C', 0);
    $pdf->Cell(50, 8, 'Asunto', 1, 0, 'C', 0);
    $pdf->Cell(15, 8, 'Folios', 1, 0, 'C', 0);
    $pdf->Cell(50, 8, 'Usuario', 1, 0, 'C', 0);
    $pdf->Cell(60, 8, mb_convert_encoding('Área','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(35, 8, 'Estado Doc', 1, 0, 'C', 0);
    $pdf->Cell(35, 8, mb_convert_encoding('Estado Envío','ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
}else if ($_POST['usuarioText'] != 'Seleccionar' && $_POST['numDocumento'] == ''){
    $pdf->Cell(30, 8, 'Tipo Documento', 1, 0, 'C', 0);
    $pdf->Cell(30, 8, 'Nro Documento', 1, 0, 'C', 0);
    $pdf->Cell(70, 8, 'Asunto', 1, 0, 'C', 0);
    $pdf->Cell(15, 8, 'Folios', 1, 0, 'C', 0);
    $pdf->Cell(50, 8, mb_convert_encoding('Área','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(40, 8, 'Estado Documento', 1, 0, 'C', 0);
    $pdf->Cell(45, 8, mb_convert_encoding('Estado Envío','ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
}else{
    $pdf->Cell(30, 8, 'Tipo Doc', 1, 0, 'C', 0);
    $pdf->Cell(30, 8, 'Nro Doc', 1, 0, 'C', 0);
    $pdf->Cell(50, 8, 'Asunto', 1, 0, 'C', 0);
    $pdf->Cell(15, 8, 'Folios', 1, 0, 'C', 0);
    $pdf->Cell(40, 8, 'Usuario', 1, 0, 'C', 0);
    $pdf->Cell(40, 8, mb_convert_encoding('Área','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
    $pdf->Cell(35, 8, 'Estado Doc', 1, 0, 'C', 0);
    $pdf->Cell(35, 8, mb_convert_encoding('Estado Envío','ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
}


$pdf->SetFillColor(233, 229, 235);
$pdf->SetFont('Arial','',10);

if ($_POST['usuarioText'] != 'Seleccionar' && $_POST['numDocumento'] != ''){
    $pdf->SetWidths(array(40, 70, 15, 60, 45, 45));
} else if ($_POST['usuarioText'] == 'Seleccionar' && $_POST['numDocumento'] != '') {
    $pdf->SetWidths(array(30, 50, 15, 50, 60, 35, 35));
}else if ($_POST['usuarioText'] != 'Seleccionar' && $_POST['numDocumento'] == ''){
    $pdf->SetWidths(array(30, 30, 70, 15, 50, 40, 45));
}else{
    $pdf->SetWidths(array(30, 30, 50, 15, 40, 40, 35, 35));
}


session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Documento.php";

$documentoModel = new Documento();

$response = [];

$numDocumento = null ;
$codUsuario = null;

if ($_SESSION['user']['rol'] == 'administrador'){
    if (isset($_POST['usuario']) && isset($_POST['numDocumento']) && $_POST['usuario']!= 0){
        $codUsuario = $_POST['usuario'];
        $numDocumento = $_POST['numDocumento'];
    }else if(isset($_POST['usuario']) && isset($_POST['numDocumento']) && $_POST['usuario']== 0){
        $numDocumento = $_POST['numDocumento'];
    }
}else if($_SESSION['user']['rol'] == 'usuario'){
    $codUsuario = $_SESSION['user']['codUsuarioArea'];
    if(isset($_POST['numDocumento'])){
        $numDocumento = $_POST['numDocumento'];
    }
}

if($codUsuario && $numDocumento) {
    $response = $documentoModel->reportesPorUsuario(null, $numDocumento,(int) $codUsuario, null, null);
} else if ($numDocumento){
    $response = $documentoModel->reportesPorUsuario(null, $numDocumento, null, null, null);
}else if ($codUsuario){
    $response = $documentoModel->reportesPorUsuario(null, null, $codUsuario, null, null);
}else{
    $response = $documentoModel->reportesPorUsuario(null, null, null, null, null);
}

foreach ($response['data'] as $documento) {
    if ($_POST['usuarioText'] != 'Seleccionar' && $_POST['numDocumento'] != ''){
        $pdf->Row(array(
            mb_convert_encoding( $documento['tipoDocumento'],'ISO-8859-1', 'UTF-8'),
            mb_convert_encoding($documento['asunto'],'ISO-8859-1', 'UTF-8'),
            $documento['folios'],
            mb_convert_encoding($documento['area'],'ISO-8859-1', 'UTF-8'),
            $documento['estadoDocumento'] == 'a' ? 'En seguimiento' : 'Seguimiento Finalizado',
            $documento['estadoRecepcion'] == 'a' ? 'Recepcionado' : mb_convert_encoding('Pendiente de Recepción','ISO-8859-1', 'UTF-8')
        ), 10);
    } else if ($_POST['usuarioText'] == 'Seleccionar' && $_POST['numDocumento'] != '') {
        $pdf->Row(array(
            mb_convert_encoding( $documento['tipoDocumento'],'ISO-8859-1', 'UTF-8'),
            mb_convert_encoding($documento['asunto'],'ISO-8859-1', 'UTF-8'),
            $documento['folios'],
            mb_convert_encoding($documento['usuario'],'ISO-8859-1', 'UTF-8'),
            mb_convert_encoding($documento['area'],'ISO-8859-1', 'UTF-8'),
            $documento['estadoDocumento'] == 'a' ? 'En seguimiento' : 'Seguimiento Finalizado',
            $documento['estadoRecepcion'] == 'a' ? 'Recepcionado' : mb_convert_encoding('Pendiente de Recepción','ISO-8859-1', 'UTF-8')
        ), 10);
    }else if ($_POST['usuarioText'] != 'Seleccionar' && $_POST['numDocumento'] == ''){
        $pdf->Row(array(
            mb_convert_encoding( $documento['tipoDocumento'],'ISO-8859-1', 'UTF-8'),
            $documento['NumDocumento'],
            mb_convert_encoding($documento['asunto'],'ISO-8859-1', 'UTF-8'),
            $documento['folios'],
            mb_convert_encoding($documento['area'],'ISO-8859-1', 'UTF-8'),
            $documento['estadoDocumento'] == 'a' ? 'En seguimiento' : 'Seguimiento Finalizado',
            $documento['estadoRecepcion'] == 'a' ? 'Recepcionado' : mb_convert_encoding('Pendiente de Recepción','ISO-8859-1', 'UTF-8')
        ), 10);
    }else{
        $pdf->Row(array(
            mb_convert_encoding( $documento['tipoDocumento'],'ISO-8859-1', 'UTF-8'),
            $documento['NumDocumento'],
            mb_convert_encoding($documento['asunto'],'ISO-8859-1', 'UTF-8'),
            $documento['folios'],
            mb_convert_encoding($documento['usuario'],'ISO-8859-1', 'UTF-8'),
            mb_convert_encoding($documento['area'],'ISO-8859-1', 'UTF-8'),
            $documento['estadoDocumento'] == 'a' ? 'En seguimiento' : 'Seguimiento Finalizado',
            $documento['estadoRecepcion'] == 'a' ? 'Recepcionado' : mb_convert_encoding('Pendiente de Recepción','ISO-8859-1', 'UTF-8')
        ), 10);
    }


}

$pdf->Output();
?>

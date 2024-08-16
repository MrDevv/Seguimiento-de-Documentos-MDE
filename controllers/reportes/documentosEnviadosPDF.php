<?php
require('../../plugins/fpdf/fpdf.php');
date_default_timezone_set('America/Lima');

class PDF extends FPDF{

    private $fechaActual;
    private $horaActual;
    private $nombreUsuario;
    private $fechaInicio;

    function __construct($fecha, $hora, $nombreUsuario, $fechaInicio) {
        parent::__construct();
        $this->fechaActual = $fecha;
        $this->horaActual = $hora;
        $this->nombreUsuario = $nombreUsuario;
        $this->fechaInicio = $fechaInicio;
    }

    function Header(){
        $this->SetFont('Arial','',10);
//        $this->SetXY(1, 2);
//        $this->Cell(35, 5,'Sistema de Seguimiento de Documentos Internos y Externos', 0, 1, 'L', 0);

        $this->SetXY(260, 2);
        $this->Cell(35, 5,'Fecha: ' .$this->fechaActual, 0, 1, 'L', 0);
        $this->SetX(260);
        $this->Cell(35, 5,'Hora:  '.$this->horaActual, 0, 0, 'L', 0);

        $this->SetFont('Arial','B',20);
        $this->Image('../../assets/logo.png', 5, 2, 35);
        $this->SetXY(80, 12);

        $this->Cell(150, 15, mb_convert_encoding('REPORTE DE DOCUMENTOS','ISO-8859-1', 'UTF-8'), 0, 1, 'C', 0);
        $this->Ln(10);
        $this->SetX(80);

        $this->SetFont('Arial','',12);
        $this->SetX(50);
        $this->Cell(130, 8, mb_convert_encoding('Usuario: '.$this->nombreUsuario,'ISO-8859-1', 'UTF-8'), 0, 0, 'L', 0);
        $this->Cell(130, 8, mb_convert_encoding('Área: '.$_POST['areaUsuario'],'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
        $this->SetFont('Arial','',12);
        $this->SetX(50);

        if ($_POST['fechaInicio'] != '' && $_POST['fechaFin'] != '' && $_POST['numDocumento'] != '') {
            $this->Cell(90, 8, 'Desde: '.$this->fechaInicio, 0, 0, 'L', 0);
            $this->Cell(90, 8, 'Hasta: '.$_POST['fechaFin'], 0, 0, 'L', 0);
            $this->Cell(90, 8, mb_convert_encoding('Documento: '.$_POST['numDocumento'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
        }

        if ($_POST['fechaInicio'] != '' && $_POST['fechaFin'] == '' && $_POST['numDocumento'] == '') {
            $this->Cell(90, 8, 'Desde: '.$this->fechaInicio, 0, 1, 'L', 0);
        }

        if ($_POST['fechaInicio'] == '' && $_POST['fechaFin'] != '' && $_POST['numDocumento'] == '') {
            $this->Cell(90, 8, 'Hasta: '.$_POST['fechaFin'], 0, 1, 'L', 0);
        }

        if ($_POST['fechaInicio'] == '' && $_POST['fechaFin'] == '' && $_POST['numDocumento'] != '') {
            $this->Cell(90, 8, mb_convert_encoding('Documento: '.$_POST['numDocumento'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
        }

        if ($_POST['fechaInicio'] != '' && $_POST['fechaFin'] == '' && $_POST['numDocumento'] != '') {
            $this->Cell(90, 8, 'Desde: '.$this->fechaInicio, 0, 0, 'L', 0);
            $this->Cell(90, 8, mb_convert_encoding('Documento: '.$_POST['numDocumento'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
        }

        if ($_POST['fechaInicio'] == '' && $_POST['fechaFin'] != '' && $_POST['numDocumento'] != '') {
            $this->Cell(90, 8, 'Hasta: '.$_POST['fechaFin'], 0, 0, 'L', 0);
            $this->Cell(90, 8, mb_convert_encoding('Documento: '.$_POST['numDocumento'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);
        }

        if ($_POST['fechaInicio'] != '' && $_POST['fechaFin'] != '' && $_POST['numDocumento'] == '') {
            $this->Cell(90, 8, 'Desde: '.$this->fechaInicio, 0, 0, 'L', 0);
            $this->Cell(90, 8, 'Hasta: '.$_POST['fechaFin'], 0, 1, 'L', 0);
        }

//        $this->Cell(90, 8, 'Desde: '.$this->fechaInicio, 0, 0, 'L', 0);
//        $this->Cell(90, 8, 'Hasta: '.$_POST['fechaFin'], 0, 0, 'L', 0);
//        $this->Cell(90, 8, mb_convert_encoding('Documento: '.$_POST['numDocumento'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'L', 0);

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
            $this->Cell(30, 8, 'Nro Doc', 1, 0, 'C', 0);
            $this->Cell(30, 8, 'Tipo Doc', 1, 0, 'C', 0);
            $this->Cell(50, 8, 'Asunto', 1, 0, 'C', 0);
            $this->Cell(15, 8, 'Folios', 1, 0, 'C', 0);
            $this->Cell(40, 8, 'Usuario Destino', 1, 0, 'C', 0);
            $this->Cell(40, 8, mb_convert_encoding('Área Destino','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
            $this->Cell(35, 8, 'Fecha Envio', 1, 0, 'C', 0);
            $this->Cell(35, 8, 'Estado Documento', 1, 1, 'C', 0);

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

// Obtener la fecha, hora y nombre del usuario desde la sesión

$fechaActual = date('Y-m-d');
$horaActual = date('H:i');
$nombreUsuario = $_POST['nombresUsuario'];
$fechaInicio = $_POST['fechaInicio'];

$pdf = new PDF($fechaActual, $horaActual, $nombreUsuario, $fechaInicio);
$pdf->AliasNbPages();
$pdf->AddPage('L');
//$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetX(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30, 8, 'Nro Doc', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Tipo Doc', 1, 0, 'C', 0);
$pdf->Cell(50, 8, 'Asunto', 1, 0, 'C', 0);
$pdf->Cell(15, 8, 'Folios', 1, 0, 'C', 0);
$pdf->Cell(40, 8, 'Usuario Destino', 1, 0, 'C', 0);
$pdf->Cell(40, 8, mb_convert_encoding('Área Destino','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->Cell(35, 8, 'Fecha Envio', 1, 0, 'C', 0);
$pdf->Cell(35, 8, 'Estado Documento', 1, 1, 'C', 0);


$pdf->SetFillColor(233, 229, 235);
$pdf->SetFont('Arial','',9);

$pdf->SetWidths(array(30, 30, 50, 15, 40, 40, 35, 35));


session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Envio.php";

$enviadosModel = new Envio();

$numDocumento = $_POST['numDocumento'];
$fechaInicio = $_POST['fechaInicio']!='' ? $_POST['fechaInicio'] : null;
$fechaFin = $_POST['fechaFin']!='' ? $_POST['fechaFin'] : null;

$response = $enviadosModel->obtenerDocumentosEnviadosReporte(
    (int) $_SESSION['user']['codUsuarioArea'],
    null,
    null,
    $fechaInicio,
    $fechaFin,
    $numDocumento
);

foreach ($response['data'] as $documento) {


    $pdf->Row(array(
        $documento['NumDocumento'],
        mb_convert_encoding( $documento['tipo documento'],'ISO-8859-1', 'UTF-8'),
        mb_convert_encoding($documento['asunto'],'ISO-8859-1', 'UTF-8'),
        $documento['folios'],
        mb_convert_encoding($documento['usuario destino'],'ISO-8859-1', 'UTF-8'),
        mb_convert_encoding($documento['area destino'],'ISO-8859-1', 'UTF-8'),
        $documento['fechaEnvio'],
        $documento['estado documento'] == 'a' ? 'En seguimiento' : 'Seguimiento Finalizado',
    ), 10);
}


$pdf->Output();
?>

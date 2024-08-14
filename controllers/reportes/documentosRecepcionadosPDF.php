<?php
require('../../plugins/fpdf/fpdf.php');

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
        $this->SetXY(1, 2);
        $this->Cell(35, 5,'Sistema de Seguimiento de Documentos Internos y Externos', 0, 1, 'L', 0);

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
        $this->Cell(100, 8, mb_convert_encoding('Reporte de Documentos Recepcionados','ISO-8859-1', 'UTF-8'), 0, 1, 'C', 0);
        $this->Ln(10);
        $this->SetX(5);
        $this->Cell(110, 8, mb_convert_encoding('Usuario: '.$this->nombreUsuario,'ISO-8859-1', 'UTF-8'), 1, 1, 'C', 0);
        $this->SetX(5);
        $this->Cell(110, 8, mb_convert_encoding('Area: '.$_POST['areaUsuario'],'ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
        $this->SetFont('Arial','B',12);
        $this->SetXY(120, 50);
        $this->Cell(80, 8, 'Filtros', 1, 1, 'C', 0);
        $this->SetX(120);
        $this->SetFont('Arial','',12);
        $this->Cell(80, 8, 'Fecha Inicio: '.$this->fechaInicio, 1, 1, 'C', 0);
        $this->SetX(120);
        $this->Cell(80, 8, 'Fecha Fin: '.$_POST['fechaFin'], 1, 1, 'C', 0);
        $this->SetX(120);
        $this->Cell(80, 8, mb_convert_encoding('Documento: ','ISO-8859-1', 'UTF-8').$_POST['numDocumento'], 1, 0, 'C', 0);
        $this->Ln(15);
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
            $this->Cell(13, 8, 'Folios', 1, 0, 'C', 0);
            $this->Cell(30, 8, 'Usuario Origen', 1, 0, 'C', 0);
            $this->Cell(30, 8, mb_convert_encoding('Área Origen','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
            $this->Cell(30, 8, 'Fecha Recepcion', 1, 0, 'C', 0);
            $this->Cell(23, 8, 'Estado Doc', 1, 1, 'C', 0);

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

// Obtener la fecha, hora y nombre del usuario desde la sesión
$fechaActual = date('Y-m-d');
$horaActual = date('H:i');
$nombreUsuario = $_POST['nombresUsuario'];
$fechaInicio = $_POST['fechaInicio'];

$pdf = new PDF($fechaActual, $horaActual, $nombreUsuario, $fechaInicio);
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetX(3);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(17, 8, 'Nro Doc', 1, 0, 'C', 0);
$pdf->Cell(25, 8, 'Tipo Doc', 1, 0, 'C', 0);
$pdf->Cell(38, 8, 'Asunto', 1, 0, 'C', 0);
$pdf->Cell(13, 8, 'Folios', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Usuario Origen', 1, 0, 'C', 0);
$pdf->Cell(30, 8, mb_convert_encoding('Área Origen','ISO-8859-1', 'UTF-8'), 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Fecha Recepcion', 1, 0, 'C', 0);
$pdf->Cell(23, 8, 'Estado Doc', 1, 1, 'C', 0);


$pdf->SetFillColor(233, 229, 235);
//$pdf->SetDrawColor(61, 61, 61);
$pdf->SetFont('Arial','',10);

$pdf->SetWidths(array(17, 25, 38, 13, 30, 30, 30, 23));


session_start();
require_once "../../config/DataBase.php";
require_once "../../models/Recepcion.php";

$recepcionadosModel = new Recepcion();

$numDocumento = $_POST['numDocumento'];
$fechaInicio = $_POST['fechaInicio']!='' ? $_POST['fechaInicio'] : null;
$fechaFin = $_POST['fechaFin']!='' ? $_POST['fechaFin'] : null;

$response = $recepcionadosModel->listarDocumentosRecepcionadosReporte(
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
        mb_convert_encoding($documento['usuario origen'],'ISO-8859-1', 'UTF-8'),
        mb_convert_encoding($documento['area origen'],'ISO-8859-1', 'UTF-8'),
        $documento['fechaRecepcion'],
        $documento['estado documento'] == 'a' ? 'En seguimiento' : 'Seguimiento Finalizado',
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

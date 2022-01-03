<?php
include '../sessionstart/bloqsession.php';
require_once("../conexionpdo/config.php");
$conn = conexion();
#llamamos el archivo para usar la librería
require_once("../pdf/dompdf/autoload.inc.php");

#crear el objeto DOMPDF
use Dompdf\dompdf;

$dompdf = new Dompdf();

$fecha = date('d-m-Y g:i:s A');

$html .= '<!DOCTYPE html>
<html>
<head>
  <title>' . $titulo . '</title>
 <link rel="stylesheet" type="text/css" href="reporte.css">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  
</head>
 <body>
  <script type="text/php">
if (isset($pdf)) {
    // open the PDF object - all drawing commands will
    // now go to the object instead of the current page
    $footer = $pdf->open_object();

    // get height and width of page
    $w = $pdf->get_width();
    $h = $pdf->get_height();

    // get font
    $font = Font_Metrics::get_font("helvetica", "normal");
    $txtHeight = Font_Metrics::get_font_height($font, 8);

    // draw a line along the bottom
    $y = $h - 1 * $txtHeight - 24;
    $color = array(0, 0, 0);
    $pdf->line(16, $y, $w - 16, $y, $color, 1);
    
    // set page number on the left side
    $pdf->page_text(16, $y, "Pág: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, $color);
    // set additional text
    $text = "SANE-CEJOSICA";
    $width = Font_Metrics::get_text_width($text, $font, 8);
    $pdf->text($w - $width - 16, $y, $text, $font, 8);


    // set additional text
    $text = "Fecha Emisión: ' . $fecha . '";
    $width = Font_Metrics::get_text_width($text, $font, 8);
    $pdf->text($w - $width-235, $y, $text, $font, 8);


    // close the object (stop capture)
    $pdf->close_object();

    // add the object to every page (can also specify
    // "odd" or "even")
    $pdf->add_object($footer, "all");
}
  </script>
<table style="width: 100%;">
  <tbody>
    <tr>
      <td style="width: 20%; text-align: left; height: 92px;">
        <p style="text-align: left;"><img src="../librerias/cejosicalogo.png" width="93" height="120"></p>

      </td>

      <td >
        <p style="text-align: center;"><span style="font-size: 10pt;"><strong>MINISTERIO DE EDUCACI&Oacute;N</strong></span></p>
        <p style="text-align: center;"><span style="font-size: 17.3333px;"><strong>COMPLEJO EDUCATIVO JOS&Eacute; SIME&Oacute;N CA&Ntilde;AS</strong></span></p>
        <p style="text-align: center;"><span style="font-size: 13.3333px;"><strong>"100 A&Ntilde;OS DE CULTURA"</strong></span></p>

        <p style="text-align: center;"><span style="font-size: 12px;">
          MUNICIPIO DE ZACATECOLUCA, DEPTO. LA PAZ <br> 
          DIRECCI&OacuteN: Final Avenida Juan Manuel Rodr&iacute;guez, Barrio El Calvario, Fte. ISSS <br>
        C&oacute;digo: <b>12079</b>       Distrito Educativo: 08-01</span></p>
      </td>
      <td style="width: 20%; height: 92px;">
        <p>&nbsp;<img style="text-align: right; float: right;" src="../librerias/minedd.jpg" width="150" height="85"></p>

      </td>
    </tr>
  </tbody></table>

  <div align="center"><h2 class="page-header"><span ></span> ' . $img . ' ' . $titulo . '</h2></div>
<div class="lineaHeader"><div class="celeste"></div><div class="amarillo"></div><div class="rojo"></div><div class="verde"></div></div>
</table>';

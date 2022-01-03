<?php
require_once("../pdf/dompdf/autoload.inc.php");

#crear el objeto DOMPDF
use Dompdf\dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->set('chroot', '/');

$dompdf->loadHtml("Hola");

$dompdf->setpaper("Letter");
$dompdf->render();

$dompdf->stream("reportepdf.pdf", array("Attachment" => false));

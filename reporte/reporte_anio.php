<?php

$titulo = 'REPORTE GENERAL DE AÑOS ESCOLARES';

$img = '';
$html = '';
include 'encabezado.php';
include '../perfil/permiso.php';
$html .= '<br><table id="usuarios">

<thead>
<tr class="">
<th>A&ntilde;o</th>
<th>Fecha Inicio</th>
<th>Fecha Fin</th>
<th>Descripci&oacute;n</th>
<th>Estado</th>
</tr>
</thead>
<tbody>
';
$sql = "SELECT * FROM tb_anio_escolar  ORDER BY anio DESC";

$result = $conn->query($sql);

$rows = $result->fetchAll();
if ($result->rowcount()) {
  foreach ($rows as $row) {

    $html .= '<tr>';
    $html .= '<td>' . $row['anio'] . '</td>';
    $html .= '<td>' . $row['anio_fecha_inicio'] . '</td>';
    $html .= '<td>' . $row['anio_fecha_final'] . '</td>';
    $html .= '<td>' . $row['anio_descrip'] . '</td>';
    $html .= '<td>' . $row['anio_estado'] . '</td>';
    $html .= '</tr>';
  }
} else {

  $html .= '<tr><td colspan="5"><div style="background-color: #f2f2f2;" align="center">
  
  <h4>¡Aviso!</h4>No hay años registrados<br><br>
  </div></td></tr>';
}
$html .= '</tbody>
</table>
</body>
</html>';

$options = $dompdf->getOptions();
$options->set('chroot', '/');

$dompdf->loadHtml($html);

$dompdf->setpaper("Letter");
$dompdf->render();
$dompdf->stream("reporte_años_escolares.pdf", array("Attachment" => 0));

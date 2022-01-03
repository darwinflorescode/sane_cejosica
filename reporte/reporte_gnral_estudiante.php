<?php

$titulo = 'REPORTE GENERAL DE ALUMNOS/AS';

$img = '';
$html = '';
include 'encabezado.php';
include '../perfil/permiso.php';
$html .= '<br><table id="usuarios" >

<thead>
<tr>
<th width="5%">ID</th>
<th width="60px">Foto</th>
<th width="10%">NIE</th>
<th>Nombre Alumno(a)</th>
<th width="14%">Edad</th>
<th width="10%">Sexo</th>
<th width="10%">Estado Civil</th>
<th width="10%">Fecha Nacimiento</th>
<th width="5%">Estado</th>
<th >Fecha Registro</th>
</tr>
</thead>
<tbody style="font-size: 12.5px !important; ">
';
$sql = "SELECT * FROM tb_estudiante  ORDER BY idestudiante DESC";

$result = $conn->query($sql);

$rows = $result->fetchAll();
if ($result->rowcount()) {

  foreach ($rows as $row) {

    $html .= '<tr>';
    if ($row['est_foto'] != null && file_exists($row['est_foto'])) {
      $fotografia = $row['est_foto'];
    } else {
      $fotografia = "../librerias/estudiante.jpg";
    }
    $dat = new DateTime($row['est_fecha_nace']);
    $datt = new DateTime($row['est_fecha_registro']);
    $html .= '<td>' . $row['idestudiante'] . '</td>';
    $html .= '<td><img src=' . $fotografia . ' width="50px" height="60px" ></td>';
    $html .= '<td>' . $row['est_nie'] . '</td>';
    $html .= '<td>' . $row['est_nombre'] . " " . $row['est_apellido'] . '</td>';
    $html .= '<td>' . $row['est_edad'] . ' Año(s)</td>';
    $html .= '<td>' . $row['est_sexo'] . '</td>';
    $html .= '<td>' . $row['est_estado_civil'] . '/a</td>';
    $html .= '<td>' . $dat->format('d-m-Y') . '</td>';
    $html .= '<td>' . $row['est_estado'] . '</td>';
    $html .= '<td>' . $datt->format('d-m-Y') . '</td>';

    $html .= '</tr>';
  }
} else {

  $html .= '<tr><td colspan="10"><div style="background-color: #f2f2f2;" align="center">
  
  <h4>¡Aviso!</h4>No hay estudiantes registrados en sistema<br><br>
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

$dompdf->stream("reporte de estudiantes.pdf", array("Attachment" => 0));

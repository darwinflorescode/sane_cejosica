<?php

$titulo = 'REPORTE GENERAL DE SECCIONES';
$img = '';
$html = '';
include 'encabezado.php';
include '../perfil/permiso.php';
$html .= '<br><table id="usuarios">
  
    <thead>
      <tr class="">
       <th>Servicio Educativo</th>
              <th>Turno</th>
              <th>Identificador</th>
              <th>Tipo Sección</th>
              <th>Nivel</th>
              <th>Capacidad Estudiantes</th>
              <th>Docente Responsable</th>
              <th>A&ntilde;o Escolar</th>
      </tr>
    </thead>
    <tbody>
    ';
$sql = "SELECT tb_seccion.*,tb_anio_escolar.*, tb_usuario.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar inner join tb_usuario on tb_seccion.sec_idtbuser=tb_usuario.idtb_usuario where tb_anio_escolar.anio='" . $_SESSION['anio_escolar'] . "' order by sec_servicio_ed asc";

$result = $conn->query($sql);

$rows = $result->fetchAll();
if ($result->rowcount()) {
  foreach ($rows as $row) {

    $html .= '<tr>';
    if ($row['sec_servicio_ed'] == -1) {
      $html .= '<td>Parvularia 6 A&ntilde;os</td>';
    } else if ($row['sec_servicio_ed'] == -2) {
      $html .= '<td>Parvularia 5 A&ntilde;os</td>';
    } else if ($row['sec_servicio_ed'] == -3) {
      $html .= '<td>Parvularia 4 A&ntilde;os</td>';
    } else {
      $html .= '<td>' . $row['sec_servicio_ed'] . '° Grado</td>';
    }
    $html .= '<td>' . $row['sec_turno'] . '</td>';
    $html .= '<td> "' . $row['sec_identificador'] . '"</td>';
    $html .= '<td>' . $row['sec_tipo_seccion'] . '</td>';
    if ($row['sec_servicio_ed'] < 0) {
      $html .= '<td>' . $row['sec_nivel'] . "</td>";
    } else {
      $html .= '<td>' . $row['sec_nivel'] . " Ciclo</td>";
    }

    $html .= '<td>' . $row['sec_vacante'] . '</td>';
    $html .= '<td>' . $row['user_nombre'] . ' ' . $row['user_apellido'] . '</td>';
    $html .= '<td>' . $row['anio'] . '</td>';
    $html .= '</tr>';
  }
} else {

  $html .= '<tr><td colspan="8"><div style="background-color: #f2f2f2;" align="center">
  
  <h4>¡Aviso!</h4>No hay secciones registradas<br><br>
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

$dompdf->stream("reportepdf.pdf", array("Attachment" => 0));

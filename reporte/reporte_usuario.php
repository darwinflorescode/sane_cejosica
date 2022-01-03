<?php


$titulo = 'REPORTE GENERAL DE USUARIOS';
$img = '';
$html = '';
include 'encabezado.php';

include '../perfil/permiso.php';
$html .= '<br><table id="usuarios">

<thead>
<tr class="">
<th>Nombre Completo</th>
<th>DUI</th>
<th>NIT</th>
<th>E-mail</th>
<th>Profesión</th>
<th>Estado</th>
<th>Tipo</th>
</tr>
</thead>
<tbody>
';
$sql = "SELECT tb_usuario.*,tb_tipo_usuario.* FROM tb_usuario inner join tb_tipo_usuario on tb_usuario.user_idtb_tipo_usuario = tb_tipo_usuario.idtb_tipo_usuario  ORDER BY idtb_usuario DESC";

$result = $conn->query($sql);

$rows = $result->fetchAll();
if ($result->rowcount()) {
  foreach ($rows as $row) {

    $html .= '<tr>';
    $html .= '<td>' . $row['user_nombre'] . ' ' . $row['user_apellido'] . '</td>';
    $html .= '<td>' . $row['user_dui'] . '</td>';
    $html .= '<td>' . $row['user_nit'] . '</td>';
    $html .= '<td>' . $row['user_email'] . '</td>';
    $html .= '<td>' . $row['user_profesion'] . '</td>';
    $html .= '<td>' . $row['user_estado'] . '</td>';
    $html .= '<td>' . $row['nombre'] . '</td>';

    $html .= '</tr>';
  }
} else {

  $html .= '<tr><td colspan="7"><div style="background-color: #f2f2f2;" align="center">
  
  <h4>¡Aviso!</h4>No hay Usuarios registrados<br><br>
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

$dompdf->stream("Reporte_de_Usuarios.pdf", array("Attachment" => 0));

<?php

$titulo = 'REPORTE GENERAL DE FAMILIARES DE ESTUDIANTES';
$img = '';
$html = '';
include 'encabezado.php';
include '../perfil/permiso.php';
$html .= '<br><table id="usuarios">
  
    <thead>
      <tr class="">
        <th>Nombre Completo</th>
       <th>DUI</th>
       <th>Teléfono</th>
       <th>Dirección</th>
      </tr>
    </thead>
    <tbody>
    ';
$sql = "SELECT * FROM tb_parentesco order by idtb_parentesco desc";

$result = $conn->query($sql);

$rows = $result->fetchAll();

foreach ($rows as $row) {

  $html .= '<tr>';
  $html .= '<td>' . $row['parent_nombre'] . '</td>';
  $html .= '<td>' . $row['parent_dui'] . '</td>';
  $html .= '<td>' . $row['parent_telefono'] . '</td>';
  $html .= '<td>' . $row['parent_direccion'] . '</td>';
  $html .= '</tr>';
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

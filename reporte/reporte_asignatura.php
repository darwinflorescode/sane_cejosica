<?php 

$titulo = 'REPORTE GENERAL DE ASIGNATURAS';
$img='';
$html = '';
include 'encabezado.php';
include '../perfil/permiso.php';
$html .='<br><table id="usuarios" >

<thead>
<tr class="">
<th>Código</th>
<th>Nombre Asignatura</th>
<th>Descripción</th>
</tr>
</thead>
<tbody style="text-transform: uppercase;">
';
$sql = "SELECT * FROM tb_materia order by idtb_materia desc";

$result = $conn->query($sql);

$rows = $result->fetchAll();
if ($result->rowcount()) {
  foreach ($rows as $row) { 

    $html.='<tr>';
    $html.='<td>'.$row['cod_materia'].'</td>';
    $html.='<td>'.$row['mate_nombre'].'</td>';
    $html.='<td>'.$row['mate_descripcion'].'</td>';
    $html.='</tr>';
  }
}else{

  $html.= '<tr><td colspan="3"><div style="background-color: #f2f2f2;" align="center">
  
  <h4>¡Aviso!</h4>No hay asignaturas registradas<br><br>
  </div></td></tr>';
}
$html .='</tbody>
</table>
</body>
</html>';

$options = $dompdf->getOptions();
		$options->set('chroot', '/');

		$dompdf->loadHtml($html);

		$dompdf->setpaper("Letter");
		$dompdf->render();
$dompdf->stream("reportepdf.pdf",array("Attachment"=>0));

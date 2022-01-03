<?php 

$html .= '
		<p style="font-size:11px; font-style: inherit;  " >Y para los usos que el interesado estime conveniente, se extiende la presente constancia a los '.strtolower(numtoletras(date('d'))).' días del mes de '.utf8_encode(strftime("%B")).' de '.strtolower(numtoletras(date('Y'))).'.</p>
	<div>&nbsp;</div>
	<br><br><table width="100%" style="font-size:11px;">
	<tr>
		<td align="center">F.________________________________________________</td>
		<td width="20%" ></td>
		<td align="center">F.________________________________________________</td>
	</tr>
	<tr >
		<td align="center">Profesor(a). '. $_SESSION["nom_completo"].'</td>
		<td>&nbsp;</td>
		<td align="center">Lic. Nombre Director/a</td>
	</tr>
	<tr>
		<td align="center">Encargado(a) de Registro en Sistema </td>
		<td>&nbsp;</td>
		<td align="center">Director(a) del Centro Educativo</td>
	</tr>
	</table><br><br><br>
	<table width="100%" style="font-size:11px;">
	<tr>
		<td> </td>
		<td width="20%">F.________________________________________________</td>
		<td></td>
	</tr>
	<tr>
		<td> </td>
		<td align="center">Reponsable de Estudiante</td>
		<td align="center"></td>
	</tr>

</table>';
 ?>
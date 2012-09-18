<script language="JavaScript" type="text/javascript">
	$('affiliatesViewWorking').innerHTML = '';
</script>
<div style="margin:2px">
<h2>##affiliates,1,Afiliados##</h2>
	<h1>Administración de ##affiliates,1,Afiliados##</h1>
<table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders"> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Nombre:</td> 
		<td>|-$affiliate->getName()-|</td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">ID interno</td> 
		<td> |-$affiliate->getInternalNumber()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Dirección</td> 
		<td> |-$affiliate->getAddress()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Teléfono</td> 
		<td> |-$affiliate->getPhone()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">E-mail</td> 
		<td> |-$affiliate->getEmail()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Persona contacto</td> 
		<td> |-$affiliate->getContact()-| </td> 
	</tr> 
</table>
</div>
<script language="JavaScript" type="text/javascript">
	$('vialidadSuppliersViewWorking').innerHTML = '';
</script>
<div style="margin:2px">
<h2>Proveedores</h2>
	<h1>Administración de Proveedores</h1>
<table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders"> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Nombre:</td> 
		<td>|-$supplier->getName()-|</td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Dirección</td> 
		<td> |-$supplier->getAddress()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Teléfono</td> 
		<td> |-$supplier->getPhone()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">E-mail</td> 
		<td> |-$supplier->getEmail()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Persona contacto</td> 
		<td> |-$supplier->getContact()-| </td> 
	</tr> 
</table>
</div>
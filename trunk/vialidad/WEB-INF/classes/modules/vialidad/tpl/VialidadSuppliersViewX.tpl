<script language="JavaScript" type="text/javascript">
	$('vialidadSuppliersViewWorking').innerHTML = '';
</script>
<div style="margin:2px">
<h2>Proveedores</h2>
	<h1>Administración de Proveedores</h1>
<table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders"> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Razón Social</td> 
		<td>|-$supplier->getName()-|</td> 
	</tr> 
	<tr>
	  <td nowrap class="tdTitle">RUC</td>
	  <td>|-$supplier->getRuc()-|</td>
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
		<td width="20%" nowrap class="tdTitle">web</td> 
		<td> |-$supplier->getweb()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Persona contacto</td> 
		<td> |-$supplier->getContact()-| </td> 
	</tr> 
</table>
<h3>Contactos</h3>
<table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders" width="100%"> 
<tr>
<th width="25%">Nombre</th>
<th width="25%">Cargo</th>
<th width="25%">Teléfono</th>
<th width="25%">E-mail</th>
</tr>
<tr>
<td>|-$supplier->getContact1()-|</td>
<td>|-$supplier->getPosition1()-|</td>
<td>|-$supplier->getPhone1()-|</td>
<td>|-$supplier->getContactEmail1()-|</td>
</tr>
<tr>
<td>|-$supplier->getContact2()-|</td>
<td>|-$supplier->getPosition2()-|</td>
<td>|-$supplier->getPhone2()-|</td>
<td>|-$supplier->getContactEmail2()-|</td>
</tr>
<tr>
<td>|-$supplier->getContact3()-|</td>
<td>|-$supplier->getPosition3()-|</td>
<td>|-$supplier->getPhone3()-|</td>
<td>|-$supplier->getContactEmail3()-|</td>
</tr>
</table>
</div>
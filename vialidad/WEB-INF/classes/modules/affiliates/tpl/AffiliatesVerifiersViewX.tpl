<script language="JavaScript" type="text/javascript">
	$('affiliatesViewWorking').innerHTML = '';
</script>
<div style="margin:2px">
<h2>Verificadoras</h2>
	<h1>Administración de Verificadoras</h1>
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
<h3>Contactos</h3>
<table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders" width="100%"> 
<tr>
<th width="25%">Nombre</th>
<th width="25%">Cargo</th>
<th width="25%">Teléfono</th>
<th width="25%">E-mail</th>
</tr>
<tr>
<td>|-$affiliate->getContact1()-|</td>
<td>|-$affiliate->getPosition1()-|</td>
<td>|-$affiliate->getPhone1()-|</td>
<td>|-$affiliate->getContactEmail1()-|</td>
</tr>
<tr>
<td>|-$affiliate->getContact2()-|</td>
<td>|-$affiliate->getPosition2()-|</td>
<td>|-$affiliate->getPhone2()-|</td>
<td>|-$affiliate->getContactEmail2()-|</td>
</tr>
<tr>
<td>|-$affiliate->getContact3()-|</td>
<td>|-$affiliate->getPosition3()-|</td>
<td>|-$affiliate->getPhone3()-|</td>
<td>|-$affiliate->getContactEmail3()-|</td>
</tr>
</table>
</div>
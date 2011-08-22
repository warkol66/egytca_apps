<script language="JavaScript" type="text/javascript">
	$('clientsViewWorking').innerHTML = '';
</script>
<div style="margin:2px">
<h2>##clients,1,Clientes##</h2>
	<h1>Administración de ##clients,1,Clientes##</h1>
<table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders"> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Nombre:</td> 
		<td>|-$client->getName()-|</td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">ID interno</td> 
		<td> |-$client->getInternalNumber()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Dirección</td> 
		<td> |-$client->getAddress()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Teléfono</td> 
		<td> |-$client->getPhone()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">E-mail</td> 
		<td> |-$client->getEmail()-| </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Persona contacto</td> 
		<td> |-$client->getContact()-| </td> 
	</tr> 
</table>
</div>
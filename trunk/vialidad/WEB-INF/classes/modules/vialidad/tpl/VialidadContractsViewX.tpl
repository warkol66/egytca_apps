<script language="JavaScript" type="text/javascript">
	$('vialidadContractsViewWorking').innerHTML = '';
</script>
<div style="margin:2px">
<h2>Contratos</h2>
	<h1>Administración de Contratos</h1>
<table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders"> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Contrato</td> 
		<td>|-$contract->getName()-|</td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Id de contrato (N° PAC)</td> 
		<td> |-$contract->getPacNumber()|escape-| |-if $contract->getPacNumber() ne ''-|<a href="https://www.contrataciones.gov.py/sicp/llamado/llamadosPorID.seam?nroPacParam=|-$contract->getPacNumber()-|" target="_blank" title="Ir a Contrato" ><img src="images/clear.png" class="icon iconNewsGoTo" /></a>|-/if-|  </td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Contratista</td> 
		<td> |-$contract->getContractor()-| </td> 
	</tr> 
	<tr> 
		<td colspan="2">			<input type="button" title="Ver Gráfico de ejecución" value="Ver Gráfico de ejecución" onClick="location.href='Main.php?do=vialidadCertificatesViewGraph&entityType=contract&entityId=|-$contract->getid()-|'" /></td>
	</tr> 
</table>

|-assign var=constructions value=$contract->getConstructions()-|
<h3>Obras</h3>
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<tr>
		<th width="40%">Nombre</th>
		<th width="60%">Description</th>
		</th>
	</tr>
	</thead>
	<tbody id="constructions_table_body">
	|-foreach from=$constructions item=construction name=for_constructions-|
	<tr id="construction|-$construction->getId()-|">
		<td nowrap="nowrap">|-$construction->getName()-|</td>
		<td nowrap="nowrap">|-$construction->getDescription()-|</td>
	</tr>
	|-/foreach-|
	</tbody>
</table>

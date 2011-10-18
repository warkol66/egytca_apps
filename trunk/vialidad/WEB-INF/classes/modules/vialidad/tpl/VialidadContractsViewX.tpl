<script language="JavaScript" type="text/javascript">
	$('vialidadContractsViewWorking').innerHTML = '';
</script>
<div style="margin:2px">
<h2>Contratos</h2>
	<h1>Administración de Contratos</h1>
<table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders"> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Nombre:</td> 
		<td>|-$contract->getName()-|</td> 
	</tr> 
	<tr> 
		<td width="20%" nowrap class="tdTitle">Código</td> 
		<td> |-$contract->getCode()-| </td> 
	</tr> 
</table>
</div>
<script language="JavaScript" type="text/javascript">
	$('viewWorking').innerHTML = '';
</script>

<h2>Certificados de Obra</h2>
<h1>Administración de Certificado de Obra</h1>

|-assign var=record value=$certificate->getMeasurementRecord()-|
|-assign var=construction value=$record->getConstruction()-|
  <table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders"> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Acta</td> 
      <td>|-$construction->getName()-|&nbsp;-&nbsp;|-$record->getMeasurementDate()|date_format:"%B / %Y"|@ucfirst-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Contrato</td> 
      <td>|-$record->getContract()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Obra</td> 
      <td>|-$record->getConstruction()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Fecha</td> 
      <td>|-$record->getMeasurementDate()|date_format-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Contratista</td> 
      <td>|-$construction->getContractor()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Monto del Certificado </td> 
      <td>|-$certificate->getTotalPrice()|system_numeric_format-|</td> 
    </tr> 
   </table> 

	<div id=div_itemPrices>
	<table id="table_itemPrices" class='tableTdBorders' cellpadding='5' cellspacing='0'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="50%">Item</th> 
			<th width="10%">Cantidad</th> 
			<th width="5%">Unidad</th> 
			<th width="10%">Precio unitario</th>
			<th width="15%">Precio total</th>
		</tr>
		</thead>
		<tbody>
		|-if $relations->count() eq 0-|
		<tr>
			<td colspan="5">No hay Items que mostrar</td>
		</tr>
		|-else-|
		|-foreach from=$relations item=relation name=for_relations-|
		<tr>
			|-assign var=item value=$relation->getConstructionItem()-|
			<td>|-$item->getName()-|</td>
			<td align="right">|-$relation->getQuantity()|system_numeric_format-|</td>
			<td align="center">|-$item->getMeasureUnit()-|</td>
			<td align="right">|-$relation->getPrice()|system_numeric_format-|</td>
			<td align="right">|-$relation->getTotalPrice()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>
</div>


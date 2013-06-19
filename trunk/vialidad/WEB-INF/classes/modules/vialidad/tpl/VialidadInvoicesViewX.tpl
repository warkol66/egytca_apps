<script language="JavaScript" type="text/javascript">
	$('viewWorking').innerHTML = '';
</script>

<h2>Facturas</h2>
<h1>Facturas de Contratistas</h1>

|-assign var=certificate value=$invoice->getCertificate()-|
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
      <td width="20%" nowrap class="tdTitle">Factura contratista</td> 
      <td>|-$invoice->getContractorNumber()|escape-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Monto del certificado</td> 
      <td>|-$certificate->getTotalPrice()|system_numeric_format-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Monto de la factura</td> 
      <td>|-$invoice->getTotalPrice()|system_numeric_format-|</td> 
    </tr> 
   </table> 
<br>

	<div id=div_itemPrices>
	<table id="table_itemPrices" class='tableTdBorders' cellpadding='5' cellspacing='0'> 
		<thead>
		<tr class="thFillTitle"> 
			<th colspan="5">Items de Construcción</th> 
		</tr>
		<tr class="thFillTitle"> 
			<th width="60%">Item</th> 
			<th width="10%">Cantidad</th> 
			<th width="5%">Unidad</th> 
			<th width="10%">Precio unitario</th>
			<th width="15%">Precio total</th>
		</tr>
		</thead>
		<tbody>
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
		<tr class="thFillTitle"> 
			<th colspan="4">Subtotal items de construcción</th>
			<td class="right">|-assign var=totalItems value=$certificate->getConstructionItemsPrice()-||-$totalItems|system_numeric_format-|</td>
		</tr>
		<tr class="thFillTitle"> 
			<th colspan="4">Ajustes</th>
			<td class="right">|-assign var=recordDate value=$record->getMeasurementdate()|date_format-|
			|-assign var=adjustedPrice value=$certificate->getAdjustedPrice($recordDate)-|
			|-if $adjustedPrice eq 0-|
				|-assign var=constructionItemsAdjustment value=0-|
			|-else if $adjustedPrice gt $totalItems-|
				|-math equation="a-b" a=$totalItems b=$adjustedPrice assign=constructionItemsAdjustment-|
			|-else if $adjustedPrice lt $totalItems-|
				|-math equation="b-a" a=$totalItems b=$adjustedPrice assign=constructionItemsAdjustment-|
			|-/if-|
			|-$constructionItemsAdjustment|system_numeric_format-|</td>
		</tr>
		<tr class="thFillTitle"> 
			<th colspan="4">Total items de construcción</th>
			<td class="right">|-math equation="a+b" a=$totalItems b=$constructionItemsAdjustment assign=totalAdjusted-||-$totalAdjusted|system_numeric_format-|</td>
		</tr>
		</tbody>
	</table>
	<br>
	<table id="table_itemPrices" class='tableTdBorders' cellpadding='5' cellspacing='0'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="50%" colspan="3">Concepto</th> 
			<th width="10%">Fecha</th> 
			<th width="10%">Importe</th>
		</tr>
		</thead>
		<tbody>
		|-assign var=fines value=$certificate->getMeasurementRecord()->getFines()-|
		|-assign var=dailyWorks  value=$certificate->getMeasurementRecord()->getDailyWorks()-|
		|-assign var=adjustments  value=$certificate->getMeasurementRecord()->getAdjustments()-|
		|-assign var=others  value=$certificate->getMeasurementRecord()->getOthers()-|

|-include
	file="VialidadInvoicesExtraTableInclude.tpl"
	extras=$fines
	extraName="Multas"
-|
|-include
	file="VialidadInvoicesExtraTableInclude.tpl"
	extras=$dailyWorks
	extraName="Trabajos por día"
-|
|-include
	file="VialidadInvoicesExtraTableInclude.tpl"
	extras=$adjustments
	extraName="Ajustes"
-|

	<tr>
		<th colspan="5" class="thFillTitle">Recupero de Anticipo</th>
	</tr>
<tr>
	<td nowrap="nowrap" colspan="3">Recupero de Anticipo</td>
	<td nowrap="nowrap" align="center">&nbsp;</td>
	<td nowrap="nowrap" align="right">|-$invoice->getAdvancePaymentRecovery()|system_numeric_format-|</td>
</tr>
	<tr>
		<th colspan="5" class="thFillTitle">Retención</th>
	</tr>
<tr>
	<td nowrap="nowrap"  colspan="3">Retención</td>
	<td nowrap="nowrap" align="center">&nbsp;</td>
	<td nowrap="nowrap" align="right">|-$invoice->getWithholding()|system_numeric_format-|</td>
</tr>

		</tbody>
	</table>
	</div>


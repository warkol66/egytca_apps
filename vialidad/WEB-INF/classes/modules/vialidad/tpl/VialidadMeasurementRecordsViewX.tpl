<script language="JavaScript" type="text/javascript">
	$('viewWorking').innerHTML = '';
</script>
 <div style="margin:2px"> 
<h2>Actas de Medición</h2>
  <h1>Administración de Actas de Medición</h1> 
  <table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders"> 
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
     <tr> |-assign var=construction value=$record->getConstruction()-|
      <td width="20%" nowrap class="tdTitle">Contratista</td> 
      <td>|-$construction->getContractor()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Fiscalizadora</td> 
      <td>|-$construction->getVerifier()-|</td> 
    </tr> 
   </table> 



	<div id=div_itemsRecords>
	<table id="table_itemsRecords" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="55%">Item</th> 
			<th width="15%">Cantidad</th> 
			<th width="5%">Unidad</th> 
			<th width="10%">Verificado</th>
			<th width="10%">Documento</th>
		</tr>
		</thead>
		<tbody>
		|-if $itemRecords->count() eq 0-|
		<tr>
			<td colspan="4">No hay Items que mostrar</td>
		</tr>
		|-else-|
		|-foreach from=$itemRecords item=itemRecord name=for_items-|
		<tr>
			|-assign var=item value=$itemRecord->getConstructionItem()-|
			<td>|-$item->getName()-|</td>
			<td align="right"><span id="quantity|-$itemRecord->getId()-|" class="inPlaceEditable">|-$itemRecord->getQuantity()|system_numeric_format-|</span></td>
			<td align="center">|-$item->getMeasureUnit()-|</td>
			<td align="center">|-$itemRecord->getVerified()|si_no-|</td>
			<td align="center">
				<input |-if $itemRecord->getDocumentid() eq ''-|style="display:none"|-/if-| onclick="window.open('Main.php?do=documentsDoDownload&view=1&id=|-$itemRecord->getDocumentid()-|')" type="button" class="icon iconView" />
			</td>
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>

	|-if $comments|@count gt 0-|
	<div id="comments">
		|-foreach from=$comments item=comment-|
		<div class="comment">
			|-assign var=commentUser value=$comment->getUser()-|
			<div class="commentUser"><h3>|-$commentUser->getUsername()-| (|-$comment->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y a las %R"-|)</h3></div>
			<div class="commentContent">|-$comment->getContent()-|</div>
		</div>
		|-/foreach-|
	</div>
	|-/if-|			
</div>

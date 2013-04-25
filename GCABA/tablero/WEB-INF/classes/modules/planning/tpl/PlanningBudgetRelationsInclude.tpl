<div id="budgetItemMsgField"></div>
|-if !$show && !$showLog-|
<script language="JavaScript" type="text/JavaScript">
function addBudgetItem(a) {
	var div = $$("#budgetItemEdit div:first")[0];
	$(a).insert({
		before: "<div>"+div.innerHTML+"</div>"
	});
	return false;
}
function addBudgetItemRow() {
	var row = document.createElement('tr');
html =   '      <tr> '
 + '		<td></td> '
 + '        <td><input type="hidden" class="item_new" name="objectType" value="|-$type-|" |-$readonly|readonly-|/>'
 + '            <input type="hidden" class="item_new" name="objectId" value="|-$objId-|" |-$readonly|readonly-|/>'
 + '            <input class="item_new width2_5em" name="budgetItem[][budgetYear]" id="params_budgetYear[]" type="text" value="" title="Año"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetJurisdiction]" id="params_budgetJurisdiction[]" type="text" value="" title="Jurisdicción"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetSubjurisdiction]" id="params_budgetSubjurisdiction[]" type="text" value="" title="SubJurisdiccion"></td>'
 + '			      <td><input class="item_new width2em" name="budgetItem[][budgetEntity]" id="params_budgetEntity[]" type="text" value="" title="Entidad"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetOgese]" id="params_budgetOgese[]" type="text" value="" title="OGESE"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetUnit]" id="params_budgetUnit[]" type="text" value="" size="1" title="Unidad Ejecutora"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetProgram]" id="params_budgetProgram[]" type="text" value="" title="Programa"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetSubProgram]" id="params_budgetSubProgram[]" type="text" value="" title="Subprograma"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetProyect]" id="params_budgetProyect[]" type="text" value="" title="Proyecto"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetActivity]" id="params_budgetActivity[]" type="text" value="" title="Actividad"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetConstruction]" id="params_budgetConstruction[]" type="text" value="" title="Obra"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetSource]" id="params_budgetSource[]" type="text" value="" title="Fuente de Financiamiento"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetCurrency]" id="params_budgetCurrency[]" type="text" value="" title="Moneda"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetSubsection]" id="params_budgetSubsection[]" type="text" value="" title="Inciso"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetCapital]" id="params_budgetCapital[]" type="text" value="" title="Principal"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetPartial]" id="params_budgetPartial[]" type="text" value="" title="Parcial"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetSubpartial]" id="params_budgetSubpartial[]" type="text" value="" title="SubParcial"></td>'
 + '            <td><input class="item_new width2em" name="budgetItem[][budgetGeolocation]" id="params_budgetGeolocation[]" type="text" value="" title="Ubicacion Geográfica"></td>'
 + '            <td align="center"><input class="item_new" name="budgetItem[][total]" type="hidden" value="0"><input name="budgetItem[][total]" id="params_total[]" type="checkbox" value="1" title="Indique si se utiliza toda la partida"></td>'
 + '            <td><input class="item_new width6em" name="budgetItem[][amount]" id="params_amount[]" type="text" value="" title="Monto"></td>'
 + '						<td><input type="button" class="icon iconEdit" title="Guardar partida" value="Guardar partida" onClick="editItem(\'item_new\')" /></td>'
 + '         		<td><input type="button" class="icon iconUpdate disabled" /></td> '
 + '         		<td><input name="budgetItem[][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete" title="Eliminar partida" onclick="deleteBudgetItemRow(this.parentNode.parentNode.rowIndex)" /></td> '
 + '       </tr>';
	row.innerHTML= html;
	document.getElementById("budgetItemsTbody").appendChild(row);
	return false;
}

	function updateItem(id){
		var params = '&id='+id;
		var myAjax = new Ajax.Updater(
				{success: 'budgetItemMsgField'},
					'Main.php?do=panelBudgetRelationsDoUpdateX',
					{
						method: 'post',
						parameters: params,
						evalScripts: true
					});
		var tr = document.getElementById('budgetItemId_'+id);
		//tr.remove(); actualizarlo
		$('budgetItemMsgField').innerHTML = '<span class="inProgress">Actualizando Partida Presupuestaria</span>';
		return true;
	}

	function removeItemFromConstruction(id) {
		var params = '&id='+id;
		var myAjax = new Ajax.Updater(
				{success: 'budgetItemMsgField'},
					'Main.php?do=planningRemoveBudgetItemRelationX',
					{
						method: 'post',
						parameters: params,
						evalScripts: true
					});
		var tr = document.getElementById('budgetItemId_'+id);
		tr.remove();
		$('budgetItemMsgField').innerHTML = '<span class="inProgress">Eliminando Partida Presupuestaria</span>';
		return true;
	}
	
	function editItem(className){
		var params = Form.serializeElements($$('.'+className));
		//alert(params);
		var myAjax = new Ajax.Updater(
				{success: 'budgetItemMsgField'},
					'Main.php?do=panelBudgetRelationsDoEditX',
					{
						method: 'post',
						parameters: params,
						evalScripts: true
					});
		$('budgetItemMsgField').innerHTML = '<span class="inProgress">Guardando Partida Presupuestaria</span>';
		return true;
	}
	
</script>|-/if-|
  <div style=""> 
     <table class="tableTdBorders" id="budgetItemsTable" style="margin-bottom:15px;"> 
      <thead> 
        |-if !$show && !$showLog-| <tr> 
          <th colspan="24"><div class="rightLink"><a href="#" onclick="return addBudgetItemRow()" class="addLink" title="Agregar nuevo Monto">Agregar Nueva Partida</a></div></th> 
        </tr> |-/if-|
				|-if $budgetItems|count eq 0 && ($show || $showLog)-|
			 <tr> 
          <td colspan="24">No hay partidas presupuestarias asociadas</td> 
        </tr>
			|-else-|
         <tr> 
		  <th>&nbsp;</th>
          <th>Año</th> 
          <th>Jur</th> 
          <th>Sjur</th>
          <th>Ent</th> 
          <th>Ogese</th> 
          <th>UE</th> 
          <th>Pr</th> 
          <th>Spr</th> 
          <th>Proy</th>
          <th>Act</th>
          <th>Obra</th> 
          <th>FF</th> 
          <th>Mon</th> 
          <th>Inc</th> 
          <th>Pri</th>
          <th>Par</th> 
          <th>Spar</th> 
          <th>Ub.G</th> 
          <th>Total</th> 
          <th>Monto</th> 
          <th>&nbsp;</th> 
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr> 
       </thead> 
      <tbody id="budgetItemsTbody">  |-foreach from=$budgetItems item=budgetItem name=for_contractBudgetItems-|
      <tr id="budgetItemId_|-$budgetItem->getId()-|">
			|-assign var=isUpdated value=$budgetItem->getUpdatedsigaf()-|
			<td><a href="javascript:void(null);" class="tooltipWider"><span style="padding: .3em;" id="budgetSpanId_|-$budgetItem->getId()-|"><table width="490" border="0" cellpadding="0" cellspacing="0">
  <tr align="center">
    <th>Vigente</th>
    <th>Restringido</th>
    <th>Preventivo</th>
    <th>Definitivo</th>
    <th>Devengado</th>
    <th>Pagado</th>
  </tr>
  <tr align="right">
    <td>|-$budgetItem->getActive()|system_numeric_format-|</td>
    <td>|-$budgetItem->getRestricted()|system_numeric_format-|</td>
    <td>|-$budgetItem->getPreventive()|system_numeric_format-|</td>
    <td>|-$budgetItem->getDefinitive()|system_numeric_format-|</td>
    <td>|-$budgetItem->getAccrued()|system_numeric_format-|</td>
    <td>|-$budgetItem->getPaid()|system_numeric_format-|</td>
  </tr>
</table>
			</span><img src="images/clear.png" class="icon iconInfo"></a></td>
			<td><input type="hidden" name="budgetItem[][id]" value="|-$budgetItem->getId()-|" |-$readonly|readonly:"item_|-$budgetItem->getId()-|"-|/>
			<input type="hidden" name="objectType" value="|-$type-|" |-$readonly|readonly:"item_|-$budgetItem->getId()-|"-|/>
			<input type="hidden" name="objectId" value="|-$objId-|" |-$readonly|readonly:"item_|-$budgetItem->getId()-|"-|/>
				<input name="budgetItem[][budgetYear]" id="params_budgetYear[]" type="text" value="|-$budgetItem->getBudgetYear()-|" title="Año" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2_5em"-|></td>
			<td><input name="budgetItem[][budgetJurisdiction]" id="params_budgetJurisdiction[]" type="text" value="|-$budgetItem->getBudgetJurisdiction()-|" title="Jurisdicción" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetSubjurisdiction]" id="params_budgetSubjurisdiction[]" type="text" value="|-$budgetItem->getBudgetSubjurisdiction()-|" title="SubJurisdiccion" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetEntity]" id="params_budgetEntity[]" type="text" value="|-$budgetItem->getBudgetEntity()-|" title="Entidad" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetOgese]" id="params_budgetOgese[]" type="text" value="|-$budgetItem->getBudgetOgese()-|" title="OGESE" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetUnit]" id="params_budgetUnit[]" type="text" value="|-$budgetItem->getBudgetUnit()-|" title="Unidad Ejecutora" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetProgram]" id="params_budgetProgram[]" type="text" value="|-$budgetItem->getBudgetProgram()-|" title="Programa" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetSubProgram]" id="params_budgetSubProgram[]" type="text" value="|-$budgetItem->getBudgetSubProgram()-|" title="Subprograma" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetProyect]" id="params_budgetProyect[]" type="text" value="|-$budgetItem->getBudgetProyect()-|" title="Proyecto" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetActivity]" id="params_budgetActivity[]" type="text" value="|-$budgetItem->getBudgetActivity()-|" title="Actividad" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetConstruction]" id="params_budgetConstruction[]" type="text" value="|-$budgetItem->getBudgetConstruction()-|" title="Obra" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetSource]" id="params_budgetSource[]" type="text" value="|-$budgetItem->getBudgetSource()-|" title="Fuente de Financiamiento" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetCurrency]" id="params_budgetCurrency[]" type="text" value="|-$budgetItem->getBudgetCurrency()-|" title="Moneda" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetSubsection]" id="params_budgetSubsection[]" type="text" value="|-$budgetItem->getBudgetSubsection()-|" title="Inciso" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetCapital]" id="params_budgetCapital[]" type="text" value="|-$budgetItem->getBudgetCapital()-|" title="Principal" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetPartial]" id="params_budgetPartial[]" type="text" value="|-$budgetItem->getBudgetPartial()-|" title="Parcial" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetSubpartial]" id="params_budgetSubpartial[]" type="text" value="|-$budgetItem->getBudgetSubpartial()-|" title="SubParcial" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td><input name="budgetItem[][budgetGeolocation]" id="params_budgetGeolocation[]" type="text" value="|-$budgetItem->getBudgetGeolocation()-|" title="Ubicacion Geo" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width2em"-|></td>
			<td align="center"><input name="budgetItem[][totalItem]" type="hidden" value="0"><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][totalItem]" id="params_total[]" type="checkbox" value="1" |-$budgetItem->getTotalItem()|checked_bool-| title="Indique si se utiliza toda la partida" |-$readonly|readonly:"item_|-$budgetItem->getId()-|"-|>
</td>
			<td><input name="budgetItem[][amount]" id="params_amount[]" type="text" value="|-$budgetItem->getAmount()|system_numeric_format-|" class="right" title="Monto" |-$readonly|readonly:"item_|-$budgetItem->getId()-| width6em"-|></td>
			<td>|-if !$show && !$showLog-|<input type="button" class="icon iconStoreLocal" title="Guardar partida" value="Guardar partida" onClick="editItem('item_|-$budgetItem->getId()-|')" />|-else-|<img src="images/clear.png" class="disabled icon iconClear" />|-/if-|</td>
			<td nowrap>|-if !$show && !$showLog-|
				|-if date('Y-m-d',strtotime($budgetItem->getUpdatedsigaf())) eq date("Y-m-d")-|
				<input name="updateBudgetItem" type="hidden" value="1"><input type="button" id="update_|-$budgetItem->getId()-|" class="disabled icon iconActivate" title="Actualizado hoy - Actualizar partida" value="Actualizado hoy - Actualizar partida" onClick="updateItem('|-$budgetItem->getId()-|')" />
				|-else-|
				<input name="updateBudgetItem" type="hidden" value="1"><input type="button" id="update_|-$budgetItem->getId()-|" class="icon iconUpdate" title="Actualizar partida" value="Actualizar partida" onClick="updateItem('|-$budgetItem->getId()-|')" />
				|-/if-|
				|-else-|<img src="images/clear.png" class="disabled icon iconActivate" |-if $budgetItem->getUpdatedSigaf()-|title="Partida actualizada el |-$budgetItem->getUpdatedSigaf()|change_timezone|dateTime_format-|"|-/if-| />|-/if-|</td>
         	<td>|-if !$show && !$showLog-|<input name="budgetItem[|-$budgetItem->getId()-|][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete" title="Eliminar partida" value="Eliminar partida" onClick="removeItemFromConstruction('|-$budgetItem->getId()-|')" />|-else-|<img src="images/clear.png" class="disabled icon iconClear" />|-/if-|</td> 
       </tr> 
      |-/foreach-|
      </tbody> 
			|-/if-|
     </table> 
   </div> 
<script type="text/javascript">
function deleteBudgetItemRow(i){
	document.getElementById('budgetItemsTable').deleteRow(i)
}
</script>

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
 + '        <td><input type="hidden" class="item_new" name="objectType" value="|-$type-|" |-$readonly|readonly-|/>'
 + '            <input type="hidden" class="item_new" name="objectId" value="|-$objId-|" |-$readonly|readonly-|/>'
 + '            <input class="item_new" name="budgetItem[][budgetYear]" id="params_budgetYear[]" type="text" value="" title="Año" class="width2_5em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetJurisdiction]" id="params_budgetJurisdiction[]" type="text" value="" title="Jurisdicción" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetSubjurisdiction]" id="params_budgetSubjurisdiction[]" type="text" value="" title="SubJurisdiccion" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetOgese]" id="params_budgetOgese[]" type="text" value="" title="OGESE" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetUnit]" id="params_budgetUnit[]" type="text" value="" size="1" title="Unidad Ejecutora" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetProgram]" id="params_budgetProgram[]" type="text" value="" title="Programa" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetSubProgram]" id="params_budgetSubProgram[]" type="text" value="" title="Subprograma" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetProyect]" id="params_budgetProyect[]" type="text" value="" title="Proyecto" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetActivity]" id="params_budgetActivity[]" type="text" value="" title="Actividad" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetConstruction]" id="params_budgetConstruction[]" type="text" value="" title="Obra" class="width2em"></td>'
 + '			      <td><input class="item_new" name="budgetItem[][budgetEntity]" id="params_budgetEntity[]" type="text" value="" title="Entidad" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetSource]" id="params_budgetSource[]" type="text" value="" title="Fuente de Financiamiento" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetSubsection]" id="params_budgetSubsection[]" type="text" value="" title="Inciso" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetCurrency]" id="params_budgetCurrency[]" type="text" value="" title="Moneda" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetCapital]" id="params_budgetCapital[]" type="text" value="" title="Principal" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetPartial]" id="params_budgetPartial[]" type="text" value="" title="Parcial" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetSubpartial]" id="params_budgetSubpartial[]" type="text" value="" title="SubParcial" class="width2em"></td>'
 + '            <td><input class="item_new" name="budgetItem[][budgetGeolocation]" id="params_budgetGeolocation[]" type="text" value="" title="Ubicacion Geográfica" class="width2em"></td>'
 + '            <td align="center"><input class="item_new" name="budgetItem[][total]" type="hidden" value="0"><input name="budgetItem[][total]" id="params_total[]" type="checkbox" value="1" title="Indique si se utiliza toda la partida"></td>'
 + '            <td><input class="item_new" name="budgetItem[][amount]" id="params_amount[]" type="text" value="" title="Monto" class="width6em"></td>'
 + '			<td><input type="button" class="icon iconEdit" title="Guardar partida" value="Guardar partida" onClick="editItem(\'item_new\')" /></td>'
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
          <th colspan="23"><div class="rightLink"><a href="#" onclick="return addBudgetItemRow()" class="addLink" title="Agregar nuevo Monto">Agregar Nueva Partida</a></div></th> 
        </tr> |-/if-|
				|-if $budgetItems|count eq 0 && ($show || $showLog)-|
			 <tr> 
          <td colspan="23">No hay partidas presupuestarias asociadas</td> 
        </tr>
			|-else-|
         <tr> 
          <th>Año</th> 
          <th>Jur</th> 
          <th>Sjur</th>
          <th>Ogese</th> 
          <th>UE</th> 
          <th>Pr</th> 
          <th>Spr</th> 
          <th>Proy</th>
          <th>Act</th>
          <th>Obra</th> 
          <th>Ent</th> 
          <th>Fue</th> 
          <th>Inc</th> 
          <th>Mon</th> 
          <th>Pri</th>
          <th>Par</th> 
          <th>Spar</th> 
          <th>Ubi</th> 
          <th>Total</th> 
          <th>Monto</th> 
          <th>&nbsp;</th> 
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr> 
       </thead> 
      <tbody id="budgetItemsTbody">  |-foreach from=$budgetItems item=budgetItem name=for_contractBudgetItems-|
      <tr id="budgetItemId_|-$budgetItem->getId()-|">
			<td><input type="hidden" class="item_|-$budgetItem->getId()-|" name="budgetItem[][id]" value="|-$budgetItem->getId()-|" |-$readonly|readonly-|/>
			<input type="hidden" class="item_|-$budgetItem->getId()-|" name="objectType" value="|-$type-|" |-$readonly|readonly-|/>
			<input type="hidden" class="item_|-$budgetItem->getId()-|" name="objectId" value="|-$objId-|" |-$readonly|readonly-|/>
					<input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetYear]" id="params_budgetYear[]" type="text" value="|-$budgetItem->getBudgetYear()-|" title="Año" |-$readonly|readonly:"width2_5em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetJurisdiction]" id="params_budgetJurisdiction[]" type="text" value="|-$budgetItem->getBudgetJurisdiction()-|" title="Jurisdicción" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetSubjurisdiction]" id="params_budgetSubjurisdiction[]" type="text" value="|-$budgetItem->getBudgetSubjurisdiction()-|" title="SubJurisdiccion" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetOgese]" id="params_budgetOgese[]" type="text" value="|-$budgetItem->getBudgetOgese()-|" title="OGESE" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetUnit]" id="params_budgetUnit[]" type="text" value="|-$budgetItem->getBudgetUnit()-|" title="Unidad Ejecutora" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetProgram]" id="params_budgetProgram[]" type="text" value="|-$budgetItem->getBudgetProgram()-|" title="Programa" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetSubProgram]" id="params_budgetSubProgram[]" type="text" value="|-$budgetItem->getBudgetSubProgram()-|" title="Subprograma" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetProyect]" id="params_budgetProyect[]" type="text" value="|-$budgetItem->getBudgetProyect()-|" title="Proyecto" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetActivity]" id="params_budgetActivity[]" type="text" value="|-$budgetItem->getBudgetActivity()-|" title="Actividad" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetConstruction]" id="params_budgetConstruction[]" type="text" value="|-$budgetItem->getBudgetConstruction()-|" title="Obra" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetEntity]" id="params_budgetEntity[]" type="text" value="|-$budgetItem->getBudgetEntity()-|" title="Entidad" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetSource]" id="params_budgetSource[]" type="text" value="|-$budgetItem->getBudgetSource()-|" title="Fuente de Financiamiento" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetSubsection]" id="params_budgetSubsection[]" type="text" value="|-$budgetItem->getBudgetSubsection()-|" title="Inciso" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetCurrency]" id="params_budgetCurrency[]" type="text" value="|-$budgetItem->getBudgetCurrency()-|" title="Moneda" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetCapital]" id="params_budgetCapital[]" type="text" value="|-$budgetItem->getBudgetCapital()-|" title="Principal" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetPartial]" id="params_budgetPartial[]" type="text" value="|-$budgetItem->getBudgetPartial()-|" title="Parcial" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetSubpartial]" id="params_budgetSubpartial[]" type="text" value="|-$budgetItem->getBudgetSubpartial()-|" title="SubParcial" |-$readonly|readonly:"width2em"-|></td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][budgetGeolocation]" id="params_budgetGeolocation[]" type="text" value="|-$budgetItem->getBudgetGeolocation()-|" title="Ubicacion Geo" |-$readonly|readonly:"width2em"-|></td>
			<td align="center"><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][totalItem]" type="hidden" value="0"><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][totalItem]" id="params_total[]" type="checkbox" value="1" |-$budgetItem->getTotalItem()|checked_bool-| title="Indique si se utiliza toda la partida" |-$readonly|readonly-|>
</td>
			<td><input class="item_|-$budgetItem->getId()-|" name="budgetItem[][amount]" id="params_amount[]" type="text" value="|-$budgetItem->getAmount()|system_numeric_format-|" class="right" title="Monto" |-$readonly|readonly:"width6em"-|></td>
			<td><input type="button" class="icon iconEdit" title="Guardar partida" value="Guardar partida" onClick="editItem('item_|-$budgetItem->getId()-|')" /></td>
			<td nowrap>|-if !$show && !$showLog-|
				|-if date('Y-m-d',strtotime($budgetItem->getUpdatedsigaf())) eq date("Y-m-d")-|<img src="images/clear.png" class="disabled icon iconActivate" title="Actualizado hoy" />|-else-|
				<input name="updateBudgetItem" type="hidden" value="1"><input type="button" id="update_|-$budgetItem->getId()-|" class="icon iconUpdate" title="Actualizar partida" value="Actualizar partida" onClick="updateItem('|-$budgetItem->getId()-|')" />
				|-/if-|
				|-else-|<img src="images/clear.png" class="disabled icon iconActivate" />|-/if-|</td>
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

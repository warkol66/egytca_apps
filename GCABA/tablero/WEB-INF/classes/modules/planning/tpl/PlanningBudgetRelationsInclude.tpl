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
 + '            <td><input name="budgetItem[][budgetYear]"  id="params_budgetYear[]" type="text" value="" size="4" title="Año"></td>'
 + '            <td><input name="budgetItem[][budgetJurisdiction]"  id="params_budgetJurisdiction[]" type="text" value="" size="4" title="Jurisdicción"></td>'
 + '            <td><input name="budgetItem[][budgetOgese]"  id="params_budgetOgese[]" type="text" value="" size="4" title="OGESE"></td>'
 + '            <td><input name="budgetItem[][budgetUnit]"  id="params_budgetUnit[]" type="text" value="" size="1" title="Unidad Ejecutora"></td>'
 + '            <td><input name="budgetItem[][budgetProgram]"  id="params_budgetProgram[]" type="text" value="" size="3" title="Programa"></td>'
 + '            <td><input name="budgetItem[][budgetSubProgram]"  id="params_budgetSubProgram[]" type="text" value="" size="3" title="Subprograma"></td>'
 + '            <td><input name="budgetItem[][budgetProyect]"  id="params_budgetProyect[]" type="text" value="" size="3" title="Proyecto"></td>'
 + '            <td><input name="budgetItem[][budgetActivity]"  id="params_budgetActivity[]" type="text" value="" size="2" title="Actividad"></td>'
 + '            <td><input name="budgetItem[][budgetConstruction]"  id="params_budgetConstruction[]" type="text" value="" size="2" title="Obra"></td>'
 + '			<td><input name="budgetItem[][budgetEntity]"  id="params_budgetEntity[]" type="text" value="" size="2" title="Entidad" ></td>'
 + '            <td><input name="budgetItem[][budgetSource]"  id="params_budgetSource[]" type="text" value="" size="2" title="Fuente de Financiamiento" ></td>'
 + '            <td><input name="budgetItem[][budgetSubsection]"  id="params_budgetSubsection[]" type="text" value="" size="2" title="Inciso" ></td>'
 + '            <td><input name="budgetItem[][budgetCurrency]"  id="params_budgetCurrency[]" type="text" value="" size="2" title="Moneda" ></td>'
 + '            <td><input name="budgetItem[][budgetPartial]"  id="params_budgetPartial[]" type="text" value="" size="2" title="Parcial" ></td>'
 + '            <td><input name="budgetItem[][budgetSubpartial]"  id="params_budgetSubpartial[]" type="text" value="" size="2" title="SubParcial" ></td>'
 + '            <td><input name="budgetItem[][budgetCapital]"  id="params_budgetCapital[]" type="text" value="" size="2" title="Principal" ></td>'
 + '            <td><input name="budgetItem[][budgetSubjurisdiction]"  id="params_budgetSubjurisdiction[]" type="text" value="" size="2" title="SubJurisdiccion" ></td>'
 + '            <td><input name="budgetItem[][budgetGeolocation]"  id="params_budgetGeolocation[]" type="text" value="" size="2" title="Ubicacion Geo" ></td>'
 + '            <td align="center"><input name="budgetItem[][total]" type="hidden" value="0"><input name="budgetItem[][total]" id="params_total[]" type="checkbox" value="1" title="Indique si se utiliza toda la partida"></td>'
 + '            <td><input name="budgetItem[][amount]"  id="params_amount[]" type="text" value="" size="12" title="Monto"></td>'
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
</script>|-/if-|
  <div style=""> 
     <table class="tableTdBorders" id="budgetItemsTable" style="margin-bottom:15px;"> 
      <thead> 
        |-if !$show && !$showLog-| <tr> 
          <th colspan="22"><div class="rightLink"><a href="#" onclick="return addBudgetItemRow()" class="addLink" title="Agregar nuevo Monto">Agregar Nueva Partida</a></div></th> 
        </tr> |-/if-|
				|-if $budgetItems|count eq 0 && ($show || $showLog)-|
			 <tr> 
          <td colspan="22">No hay partidas presupuestarias asociadas</td> 
        </tr>
			|-else-|
         <tr> 
          <th>Año</th> 
          <th>Jur</th> 
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
          <th>Par</th> 
          <th>Spar</th> 
          <th>Pri</th>
          <th>Sjur</th>
          <th>Ubi</th> 
          
          <th>Total</th> 
          <th>Monto</th> 
          <th>&nbsp;</th> 
          <th>&nbsp;</th> 
        </tr> 
       </thead> 
      <tbody id="budgetItemsTbody">  |-foreach from=$budgetItems item=budgetItem name=for_contractBudgetItems-|
      <tr id="budgetItemId_|-$budgetItem->getId()-|">
            <td><input type="hidden" name="budgetItem[][id]" value="|-$budgetItem->getId()-|" |-$readonly|readonly-|/>
								<input name="budgetItem[][budgetYear]"  id="params_budgetYear[]" type="text" value="|-$budgetItem->getBudgetYear()|escape-|" size="4" title="Año" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetJurisdiction]"  id="params_budgetJurisdiction[]" type="text" value="|-$budgetItem->getBudgetJurisdiction()|escape-|" size="4" title="Jurisdicción" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetOgese]"  id="params_budgetOgese[]" type="text" value="|-$budgetItem->getBudgetOgese()|escape-|" size="4" title="OGESE" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetUnit]"  id="params_budgetUnit[]" type="text" value="|-$budgetItem->getBudgetUnit()|escape-|" size="1" title="Unidad Ejecutora" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetProgram]"  id="params_budgetProgram[]" type="text" value="|-$budgetItem->getBudgetProgram()|escape-|" size="3" title="Programa" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetSubProgram]"  id="params_budgetSubProgram[]" type="text" value="|-$budgetItem->getBudgetSubProgram()|escape-|" size="3" title="Subprograma" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetProyect]"  id="params_budgetProyect[]" type="text" value="|-$budgetItem->getBudgetProyect()|escape-|" size="3" title="Proyecto" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetActivity]"  id="params_budgetActivity[]" type="text" value="|-$budgetItem->getBudgetActivity()|escape-|" size="2" title="Actividad" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetConstruction]"  id="params_budgetConstruction[]" type="text" value="|-$budgetItem->getBudgetConstruction()|escape-|" size="2" title="Obra" |-$readonly|readonly-|></td>
           
            <td><input name="budgetItem[][budgetEntity]"  id="params_budgetEntity[]" type="text" value="|-$budgetItem->getBudgetEntity()|escape-|" size="2" title="Entidad" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetSource]"  id="params_budgetSource[]" type="text" value="|-$budgetItem->getBudgetSource()|escape-|" size="2" title="Fuente de Financiamiento" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetSubsection]"  id="params_budgetSubsection[]" type="text" value="|-$budgetItem->getBudgetSubsection()|escape-|" size="2" title="Inciso" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetCurrency]"  id="params_budgetCurrency[]" type="text" value="|-$budgetItem->getBudgetCurrency()|escape-|" size="2" title="Moneda" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetPartial]"  id="params_budgetPartial[]" type="text" value="|-$budgetItem->getBudgetPartial()|escape-|" size="2" title="Parcial" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetSubpartial]"  id="params_budgetSubpartial[]" type="text" value="|-$budgetItem->getBudgetSubpartial()|escape-|" size="2" title="SubParcial" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetCapital]"  id="params_budgetCapital[]" type="text" value="|-$budgetItem->getBudgetCapital()|escape-|" size="2" title="Principal" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetSubjurisdiction]"  id="params_budgetSubjurisdiction[]" type="text" value="|-$budgetItem->getBudgetSubjurisdiction()|escape-|" size="2" title="SubJurisdiccion" |-$readonly|readonly-|></td>
            <td><input name="budgetItem[][budgetGeolocation]"  id="params_budgetGeolocation[]" type="text" value="|-$budgetItem->getBudgetGeolocation()|escape-|" size="2" title="Ubicacion Geo" |-$readonly|readonly-|></td>
            
            <td align="center"><input name="budgetItem[][totalItem]" type="hidden" value="0"><input name="budgetItem[][totalItem]" id="params_total[]" type="checkbox" value="1" |-$budgetItem->getTotalItem()|checked_bool-| title="Indique si se utiliza toda la partida" |-$readonly|readonly-|>
			</td>
            <td><input name="budgetItem[][amount]"  id="params_amount[]" type="text" value="|-$budgetItem->getAmount()|system_numeric_format-|" class="right" size="12" title="Monto" |-$readonly|readonly-|></td>
			<td nowrap>|-if !$show && !$showLog-|
				|-if date('Y-m-d',strtotime($budgetItem->getUpdatedsigaf())) eq date("Y-m-d")-|<img src="images/clear.png" class="disabled icon iconActivate" title="Actualizado hoy" />|-else-|
				<input name="updateBudgetItem" type="hidden" value="1"><input type="button" id="update_|-$budgetItem->getId()-|" class="icon iconEdit" title="Actualizar partida" value="Actualizar partida" onClick="updateItem('|-$budgetItem->getId()-|')" />
				|-/if-|
				|-else-|<img src="images/clear.png" class="disabled icon iconEdit" />|-/if-|</td>
         	<td>|-if !$show && !$showLog-|<input name="budgetItem[][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete" title="Eliminar partida" value="Eliminar partida" onClick="removeItemFromConstruction('|-$budgetItem->getId()-|')" />|-else-|<img src="images/clear.png" class="disabled icon iconClear" />|-/if-|</td> 
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

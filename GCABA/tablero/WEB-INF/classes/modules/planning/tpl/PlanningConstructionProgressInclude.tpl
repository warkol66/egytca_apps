|-if !$show && !$showLog-|
<div id="progressRecordMsgField"></div>
<script language="JavaScript" type="text/JavaScript">
function addProgressRecord(a) {
	var div = $$("#progressRecordEdit div:first")[0];
	$(a).insert({
		before: "<div>"+div.innerHTML+"</div>"
	});
	return false;
}
function addProgressRecordRow() {
	var row = document.createElement('tr');
html =   '      <tr> '
 + '            <td><input name="progressRecord[][year]"  id="params_year[]" type="text" value="" size="4" class="right" title="Año (yyyy)"></td>'
 + '            <td><input name="progressRecord[][month]"  id="params_month[]" type="text" value="" size="4" class="right" title="Mes (mm)"></td>'
 + '            <td><input name="progressRecord[][physicalProgress]"  id="params_physicalProgress[]" type="text" value="" size="4" class="right" title="Avance Físico en Porcentaje"> % </td>'
 + '            <td> $ <input name="progressRecord[][financialProgress]"  id="params_financialProgress[]" type="text" value="" size="12" class="right" title="Avance Físico en Pesos"></td>'
 + '         		<td><input name="progressRecord[][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete" title="Eliminar partida" onclick="deleteProgressRow(this.parentNode.parentNode.rowIndex)" /></td> '
 + '       </tr>';
	row.innerHTML= html;
	document.getElementById("progressRecordsTbody").appendChild(row);
	return false;
}
	function removeRecordFromConstruction(id) {
		var params = '&id='+id;
		var myAjax = new Ajax.Updater(
				{success: 'progressRecordMsgField'},
					'Main.php?do=planningRemoveProgressRecordX',
					{
						method: 'post',
						parameters: params,
						evalScripts: true
					});
		var tr = document.getElementById('progressRecordId_'+id);
		tr.remove();
		$('progressRecordMsgField').innerHTML = '<span class="inProgress">Eliminando Registro de Evolución</span>';
		return true;
	}
</script>|-/if-|
  <div style="margin-left:150px;"> 
     <table class="tableTdBorders" id="progressRecordsTable" style="display:none; margin-bottom:15px;"> 
      <thead> 
        |-if !$show && !$showLog-| <tr> 
          <th colspan="5"><div class="rightLink"><a href="#" onclick="return addProgressRecordRow()" class="addLink" title="Agregar nuevo Monto">Agregar Nuevo Registro</a></div></th> 
        </tr> |-/if-|
				|-if $progressRecords|count eq 0 && ($show || $showLog)-|
			 <tr> 
          <td colspan="5">No hay registros de evolución</td> 
        </tr>
			|-else-|
         <tr> 
          <th>Año</th> 
          <th>Mes</th> 
          <th>Avance Físico</th> 
          <th>Avance Financiero</th> 
          <th>&nbsp;</th> 
        </tr> 
       </thead> 
      <tbody id="progressRecordsTbody">  |-foreach from=$progressRecords item=progressRecord name=for_contractProgressRecords-|
      <tr id="progressRecordId_|-$progressRecord->getId()-|"> 
            <td><input type="hidden" name="progressRecord[][id]" value="|-$progressRecord->getId()-|" class="right" |-$readonly|readonly-|/>
								<input name="progressRecord[][year]"  id="params_year[]" type="text" value="|-$progressRecord->getYear()-|" size="4" title="Año (yyyy)" class="right" |-$readonly|readonly-|></td>
            <td><input name="progressRecord[][month]"  id="params_month[]" type="text" value="|-$progressRecord->getMonth()-|" size="4" title="Mes (mm)" class="right" |-$readonly|readonly-|></td>
            <td><input name="progressRecord[][physicalProgress]"  id="params_physicalProgress[]" type="text" value="|-$progressRecord->getPhysicalProgress()|system_numeric_format-|" size="4" title="Avance Físico en Porcentaje" class="right" |-$readonly|readonly-|> % </td>
            <td> $ <input name="progressRecord[][financialProgress]"  id="params_financialProgress[]" type="text" value="|-$progressRecord->getFinancialProgress()|system_numeric_format-|" size="12" title="Avance Financiero en Pesos" class="right" |-$readonly|readonly-|></td>
         		<td>|-if !$show && !$showLog-|<input name="progressRecord[][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete" title="Eliminar partida" value="Eliminar partida" onClick="removeRecordFromConstruction('|-$progressRecord->getId()-|')" />|-else-|<img src="images/clear.png" class="disabled icon iconClear" />|-/if-|</td> 
       </tr> 
      |-/foreach-|
      </tbody> 
			|-/if-|
     </table> 
   </div> 
<script type="text/javascript">
function deleteProgressRow(i){
	document.getElementById('progressRecordsTable').deleteRow(i)
}
</script>
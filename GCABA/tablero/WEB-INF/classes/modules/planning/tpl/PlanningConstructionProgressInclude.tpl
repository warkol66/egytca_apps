<div id="progressRecordMsgField"></div>
|-if !$show && !$showLog-|
<script language="JavaScript" type="text/JavaScript">
function addProgressRecord(a) {
	var div = $$("#progressRecordEdit div:first")[0];
	$(a).insert({
		before: "<div>"+div.innerHTML+"</div>"
	});
	return false;
}
function addProgressRecordRow() {
	var ms = new Date().getTime();
	var row = document.createElement('tr');
html =   '      <tr> '
 + '            <td><input name="progressRecord[' + ms + '][year]"  id="params_year[]" type="text" value="" size="4" class="right" title="Año (yyyy)"></td>'
 + '            <td><input name="progressRecord[' + ms + '][month]"  id="params_month[]" type="text" value="" size="4" class="right" title="Mes (mm)"></td>'
 + '            <td><input name="progressRecord[' + ms + '][physicalProgress]"  id="params_physicalProgress[]" type="text" value="" style="width: 4em !Important;" class="right" title="Avance Físico en Porcentaje"> % </td>'
 + '            <td> $ <input name="progressRecord[' + ms + '][financialProgress]"  id="params_financialProgress[]" type="text" value="" style="width: 8em !Important;" class="right" title="Avance Finaciero en Pesos"></td>'
 + '            <td><input name="progressRecord[' + ms + '][realPhysicalProgress]"  id="params_physicalProgress[]" type="text" value="" style="width: 4em !Important;" class="right" title="Avance Físico real en Porcentaje"> % </td>'
 + '            <td> $ <input name="progressRecord[' + ms + '][realFinancialProgress]"  id="params_financialProgress[]" type="text" value="" style="width: 8em !Important;" class="right" title="Avance Finaciero real en Pesos"></td>'
 + '            <td>&nbsp;</td><td>&nbsp;</td>'
 + '         		<td><input name="progressRecord[' + ms + '][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete disable" title="Eliminar registro" onclick="deleteProgressRow(this.parentNode.parentNode.rowIndex)" /></td> '
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
     <table class="tableTdBorders" id="progressRecordsTable" style="display:block; margin-bottom:15px;"> 
      <thead> 
        |-if !$show && !$showLog-| <tr> 
          <th colspan="9"><div class="rightLink"><a href="#" onclick="return addProgressRecordRow()" class="addLink" title="Agregar nuevo Monto">Agregar Nuevo Registro</a></div></th> 
        </tr> |-/if-|
				|-if $progressRecords|count eq 0 && ($show || $showLog)-|
			 <tr> 
          <td colspan="9">No hay registros de evolución</td> 
        </tr>
			|-else-|
         <tr> 
          <th>Año</th> 
          <th>Mes</th> 
          <th>Avance Físico</th> 
          <th>Avance Financiero</th> 
          <th>Avance Físico Real</th> 
          <th>Avance Financiero Real</th> 
          <th>Desvío Físico</th> 
          <th>Desvío Financiero</th> 
          <th>&nbsp;</th> 
        </tr> 
       </thead> 
      <tbody id="progressRecordsTbody">  |-foreach from=$progressRecords item=progressRecord name=for_contractProgressRecords-|
      <tr id="progressRecordId_|-$progressRecord->getId()-|"> 
            <td><input type="hidden" name="progressRecord[|-$progressRecord->getId()-|][id]" value="|-$progressRecord->getId()-|" class="right" |-$readonly|readonly-|/>
								<input name="progressRecord[|-$progressRecord->getId()-|][year]"  id="params_year[]" type="text" value="|-$progressRecord->getYear()-|" style="width: 3em !Important;" title="Año (yyyy)" class="right" |-$readonly|readonly-|></td>
            <td><input name="progressRecord[|-$progressRecord->getId()-|][month]"  id="params_month[]" type="text" value="|-$progressRecord->getMonth()-|" style="width: 3em !Important;" title="Mes (mm)" class="right" |-$readonly|readonly-|></td>
            <td><input name="progressRecord[|-$progressRecord->getId()-|][physicalProgress]"  id="params_physicalProgress[]" type="text" value="|-$progressRecord->getPhysicalProgress()|system_numeric_format-|" style="width: 4em !Important;" title="Avance Físico en Porcentaje" class="right" |-$readonly|readonly-|> % </td>
            <td> $ <input name="progressRecord[|-$progressRecord->getId()-|][financialProgress]"  id="params_financialProgress[]" type="text" value="|-$progressRecord->getFinancialProgress()|system_numeric_format-|" style="width: 8em !Important;" title="Avance Financiero en Pesos" class="right" |-$readonly|readonly-|></td>
            <td><input name="progressRecord[|-$progressRecord->getId()-|][realPhysicalProgress]"  id="params_realPhysicalProgress[]" type="text" value="|-$progressRecord->getRealPhysicalProgress()|system_numeric_format-|" style="width: 4em !Important;" title="Avance Físico en Porcentaje" class="right" |-$readonly|readonly-|> % </td>
            <td> $ <input name="progressRecord[|-$progressRecord->getId()-|][realFinancialProgress]"  id="params_realFinancialProgress[]" type="text" value="|-$progressRecord->getRealFinancialProgress()|system_numeric_format-|" style="width: 8em !Important;" title="Avance Financiero en Pesos" class="right" |-$readonly|readonly-|></td>
            <td align="right">|-$progressRecord->getPhysicalDelta()|system_numeric_format-| %</td>
            <td align="right">$ |-$progressRecord->getFinancialDelta()|system_numeric_format-| </td>
         		<td>|-if !$show && !$showLog-|<input name="progressRecord[|-$progressRecord->getId()-|][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete" title="Eliminar partida" value="Eliminar partida" onClick="removeRecordFromConstruction('|-$progressRecord->getId()-|')" />|-else-|<img src="images/clear.png" class="disabled icon iconClear" />|-/if-|</td> 
       </tr> 
      |-/foreach-|
			<!-- <tr> 
          <th colspan="5">Ejecución Finaciera acumulada según SIGAF (Actualizada: dd-mm-yyy)</th> 
          <th align="right"> #.###,00 &nbsp;&nbsp;&nbsp;</th> 
          <th colspan="3">&nbsp;</th> 
        </tr> -->
      </tbody> 
			|-/if-|
     </table> 
   </div> 
<script type="text/javascript">
function deleteProgressRow(i){
	document.getElementById('progressRecordsTable').deleteRow(i)
}
</script>
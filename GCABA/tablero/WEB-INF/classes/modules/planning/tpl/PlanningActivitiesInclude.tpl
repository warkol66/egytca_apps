|-if !$show && !$showLog-|
<div id="activityMsgField"></div>
<script language="JavaScript" type="text/JavaScript">
function addActivity(a) {
	var div = $$("#activityEdit div:first")[0];
	$(a).insert({
		before: "<div>"+div.innerHTML+"</div>"
	});
	return false;
}
function addActivityRow() {
	var row = document.createElement('tr');
html =   '      <tr> '
 + '            <td><input name="activity[][name]"  id="params_name[]" type="text" value="" size="60" title="Actividad"></td>'
|-if !$construction-| + '            <td><input name="activity[][startingDate]"  id="params_startingDate[]" type="text" value="" size="12" title="Fecha de inicio"></td>'|-/if-|
 + '            <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización"></td>'
 + '            <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1" title="Indique si se completó la actividad"></td>'
 + '         		<td><input name="activity[][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete" title="Eliminar partida" onclick="deleteActivityRow(this.parentNode.parentNode.rowIndex)" /></td> '
 + '       </tr>';
	row.innerHTML= html;
	document.getElementById("activitiesTbody").appendChild(row);
	return false;
}
	function removeActivity(id) {
		var params = '&id='+id;
		var myAjax = new Ajax.Updater(
				{success: 'activityMsgField'},
					'Main.php?do=planningActivitiesDoDeleteX',
					{
						method: 'post',
						parameters: params,
						evalScripts: true
					});
		var tr = document.getElementById('activityId_'+id);
		tr.remove();
		$('activityMsgField').innerHTML = '<span class="inProgress">Eliminando Actividad</span>';
		return true;
	}
</script>|-/if-|
  <div style="margin-left:130px;"> 
     <table class="tableTdBorders" id="activitiesTable"> 
      <thead> 
        |-if !$show && !$showLog-| <tr> 
          <th colspan="12"><div class="rightLink"><a href="#" onclick="return addActivityRow()" class="addLink" title="Agregar nueva actividad">Agregar Actividad</a></div></th> 
        </tr> |-/if-|
				|-*if ($show || $showLog) && $activities|@count gt 0*-|
         <tr> 
          <th>Nombre</th> 
|-if !$construction-|          <th>Fecha Inicio</th> 
          <th>Fecha fin</th> 
|-else-|
          <th>Fecha</th> 
|-/if-|
          <th>Cumplida</th> 
          <th>&nbsp;</th> 
        </tr> 
       </thead> 
      <tbody id="activitiesTbody">  |-foreach from=$activities item=activity name=for_contractActivitys-|
      <tr id="activityId_|-$activity->getId()-|"> 
            <td><input type="hidden" name="activity[][id]" value="|-$activity->getId()-|"/>
            <input name="activity[][name]" id="params_name[]" type="text" value="|-$activity->getName()|escape-|" size="60" title="Actividad" |-$readonly|readonly-|></td>
|-if !$construction-|            <td><input name="activity[][startingDate]"  id="params_startingDate[]" type="text" value="|-$activity->getStartingDate()|date_format-|" size="12" title="Fecha de inicio (dd-mm-yyyy)" |-$readonly|readonly-|></td>|-/if-|  
            <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="|-$activity->getEndingDate()|date_format-|" size="12" title="Fecha de finalización (dd-mm-yyyy)" |-$readonly|readonly-|></td>
            <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1" |-$activity->getAcomplished()|checked_bool-| title="Indique si se completó la actividad" |-$readonly|readonly-|>
        </td>
         		<td>|-if !$show && !$showLog-|<input name="activity[][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete" title="Eliminar partida" value="Eliminar partida" onClick="removeActivity('|-$activity->getId()-|')" />|-/if-|</td> 
       </tr> 
      |-/foreach-|
			|-*else*-|
			 <!--<tr> 
          <td colspan="12">No hay partidas presupuestarias asociadas</td> 
        </tr> -->
			|-*/if*-|
      </tbody> 
     </table> 
   </div> 
<p>&nbsp;</p>
<script type="text/javascript">
function deleteActivityRow(i){
	document.getElementById('activitiesTable').deleteRow(i)
}
</script>
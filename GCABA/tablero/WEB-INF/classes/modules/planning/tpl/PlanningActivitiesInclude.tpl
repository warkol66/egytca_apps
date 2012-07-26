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
        |-if !$show && !$showLog-||-if !isset($construction) || (isset($construction) && $construction->getConstructionType() eq 1)-| <tr> 
          <th colspan="6"><div class="rightLink"><a href="#" onclick="return addActivityRow()" class="addLink" title="Agregar nueva actividad">Agregar Actividad</a></div></th> 
        </tr> |-/if-||-/if-|
				|-*if ($show || $showLog) && $activities|@count gt 0*-|
         <tr> 
          <th>Nombre</th> 
|-if !$construction-|          <th>Fecha Inicio</th> 
          <th>Fecha fin</th> 
|-else-|
          <th>Fecha</th> 
|-/if-|
          <th>Cumplida</th> 
          |-if !$show && !$showLog-|<th>&nbsp;</th>|-/if-| 
        </tr> 
       </thead> 
      <tbody id="activitiesTbody">  
|-if isset($construction) && $construction->getConstructionType() eq 2-|    <tr> 
      <th colspan="4">Elaboración del proyecto</th> 
    </tr> 
    <tr> 
      <th colspan="4">Por Concurso</th> 
    </tr> 
|-else if isset($construction)-|
    <tr> 
      <th colspan="4">Diseño del Proyecto</th> 
    </tr> 
|-/if-|
 |-foreach from=$activities item=activity name=for_contractActivitys-|
|-if isset($construction) && $construction->getConstructionType() eq 2 && $activity->getName() eq "Diseño del Proyecto"-|
    <tr> 
      <th colspan="4">Diseño Propio</th> 
    </tr> 
|-else if isset($construction) && $construction->getConstructionType() eq 2 && $activity->getName() eq "Presentación EIA en APRA"-|
    <tr> 
      <th colspan="4">Evaluación del impacto Ambiental</th> 
    </tr> 
|-else if isset($construction) && $activity->getName() eq "Aprobación de Pliegos"-|
    <tr> 
      <th colspan="4">Licitación</th> 
    </tr> 
|-/if-|
 
      <tr id="activityId_|-$activity->getId()-|"> 
            <td><input type="hidden" name="activity[][id]" value="|-$activity->getId()-|"/>
            |-if isset($construction) && $construction->getConstructionType() eq 2-|<input name="activity[][name]" id="params_name[]" type="text" value="|-$activity->getName()|escape-|" size="60" title="Actividad" readonly="readonly"></td>
            |-else-|<input name="activity[][name]" id="params_name[]" type="text" value="|-$activity->getName()|escape-|" size="60" title="Actividad" |-$readonly|readonly-|>|-/if-|</td>
|-if !$construction-|            <td><input name="activity[][startingDate]"  id="params_startingDate[]" type="text" value="|-$activity->getStartingDate()|date_format-|" size="12" title="Fecha de inicio (dd-mm-yyyy)" |-$readonly|readonly-|></td>|-/if-|  
            <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="|-$activity->getEndingDate()|date_format-|" size="12" title="Fecha de finalización (dd-mm-yyyy)" |-$readonly|readonly-|></td>
            <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1" |-$activity->getAcomplished()|checked_bool-| title="Indique si se completó la actividad" |-$readonly|readonly-|>
        </td>
         		|-if !$show && !$showLog-|<td>|-if !isset($construction) || (isset($construction) && !$construction->getConstructionType() eq 2)-|<input name="activity[][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete" title="Eliminar" value="Eliminar" onClick="removeActivity('|-$activity->getId()-|')" />|-else-|<img src="images/clear.png" class="disabled icon iconClear" />|-/if-|</td>|-/if-| 
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
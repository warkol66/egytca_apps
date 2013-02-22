|-assign var="defaultOrder" value=999-|
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
 + '      <td><input name="activity[][name]"  id="params_name[]" type="text" value="" size="60" title="Actividad"></td>'
 + '      <td><input name="activity[][order]"  id="params_order[]" type="text" value="" size="3" title="Orden" ></td>'
|-if !$construction-| + '        <td><input name="activity[][startingDate]"  id="params_startingDate[]" type="text" value="" size="12" title="Fecha de inicio en formato dd-mm-aaaa" class="dateValidation"></td>'|-/if-|
 + '      <td><input name="activity[][endingDate]"  id="params_endingDate[]" type="text" value="" size="12" title="Fecha de finalización en formato dd-mm-aaaa" class="dateValidation"></td>'
 + '      <td align="center"><input name="activity[][priority]" type="hidden" value="0"><input name="activity[][priority]" id="params_priority[]" type="checkbox" value="1" title="Indique si es prioritaria"></td>'
 + '      <td align="center"><input name="activity[][priorityPercentage]" id="params_priorityPercentage[]" type="text" value="" size="5" title="Indique el porcentaje de la prioridad"></td>'
 + '      <td><input name="activity[][realStart]"  id="params_realStart[]" type="text" value="" size="12" title="Fecha de inicio real en formato dd-mm-aaaa" class="dateValidation"></td>'
 + '      <td><input name="activity[][realEnd]"  id="params_realEnd[]" type="text" value="" size="12" title="Fecha de finalización real en formato dd-mm-aaaa" class="dateValidation"></td>'
 + '      <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_acomplished[]" type="checkbox" value="1" title="Indique si se completó la actividad"></td>'
 + '      <td align="center"><input type="button" class="disabled icon iconAttach" title="Para anexar documentos primero debe guardar la actividad" /></td>'
 + '      <td><input name="activity[][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete" title="Eliminar partida" onclick="deleteActivityRow(this.parentNode.parentNode.rowIndex)" /></td> '
 + '    </tr>';
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
  <div |-if isset($margin) && $margin eq 'false'-| |-else-|style="margin-left:150px;" |-/if-|> 
     <table class="tableTdBorders" id="activitiesTable" style="margin-bottom:15px;"> 
      <thead> 
         <tr> 
          <th colspan="11">|-if !$construction-||-if $showGantt && $activities|count gt 0-|
					<input type="button" class="icon iconViewGantt" onClick='window.open("Main.php?do=planningProjectsViewX&showGantt=true&id=|-$planningProject->getid()-|","Gantt","scrollbars=1,width=800,height=600");' value="Ver Gantt" title="Ver Gantt (abre en ventana nueva)" /> Ver Gantt |-else-|<img src="images/clear.png" class="icon iconClear disabled" />|-/if-||-else-|
					|-if $showGantt && $activities|count gt 0-|<input type="button" class="icon iconViewGantt" onClick='window.open("Main.php?do=planningConstructionsViewX&showGantt=true&id=|-$construction->getid()-|","Gantt","scrollbars=1,width=800,height=600");' value="Ver Gantt" title="Ver Gantt (abre en ventana nueva)" /> Ver Gantt |-else-|<img src="images/clear.png" class="icon iconClear disabled" />|-/if-||-/if-|
					|-if !$show && !$showLog-||-if !isset($construction) || (isset($construction) && $construction->getConstructionType() eq 1)-|<div class="rightLink"><a href="#" onclick="return addActivityRow()" class="addLink" title="Agregar nueva actividad">Agregar Hitos</a></div>|-/if-|
				|-/if-|</th> 
        </tr> 
				|-*if ($show || $showLog) && $activities|@count gt 0*-|
         <tr> 
          <th>Nombre</th> 
          <th>Orden</th> 
|-if !$construction-|          <th>Fecha Inicio</th> 
          <th>Fecha fin</th> 
|-else-|
          <th>Fecha</th> 
|-/if-|
          <th>Prioritaria</th>
	  			<th>% de Prioridad</th>
          <th>Fecha inicio real</th> 
          <th>Fecha fin real</th> 
          <th>Cumplida</th> 
           |-if !$show && !$showLog-|<th>&nbsp;</th> 
         <th>&nbsp;</th>|-/if-| 
        </tr> 
       </thead> 
      <tbody id="activitiesTbody">  
|-if isset($construction) && $construction->getConstructionType() eq 2-|    <tr> 
      <th colspan="11">Elaboración del proyecto</th> 
    </tr> 
    <tr> 
      <th colspan="11">Por Concurso</th> 
    </tr> 
|-else if isset($construction)-|
    <tr> 
      <th colspan="11">Diseño del Proyecto</th> 
    </tr> 
|-/if-|
 |-foreach from=$activities item=activity name=for_contractActivitys-|
|-if isset($construction) && $construction->getConstructionType() eq 2 && $activity->getName() eq "Diseño del Proyecto"-|
    <tr> 
      <th colspan="11">Diseño Propio</th> 
    </tr> 
|-else if isset($construction) && $construction->getConstructionType() eq 2 && $activity->getName() eq "Presentación EIA en APRA"-|
    <tr> 
      <th colspan="11">Evaluación del impacto Ambiental</th> 
    </tr> 
|-else if isset($construction) && $activity->getName() eq "Aprobación de Pliegos"-|
    <tr> 
      <th colspan="11">Licitación</th> 
    </tr> 
|-/if-|
 
      <tr id="activityId_|-$activity->getId()-|"> 
            <td><input type="hidden" name="activity[][id]" value="|-$activity->getId()-|"/>
            |-if isset($construction) && $construction->getConstructionType() eq 2-|<input name="activity[][name]" id="params_name[]" type="text" value="|-$activity->getName()|escape-|" size="60" title="Actividad" readonly="readonly"></td>
            |-else-|<input name="activity[][name]" id="params_name[]" type="text" value="|-$activity->getName()|escape-|" size="60" title="Actividad" |-$readonly|readonly-|>|-/if-|</td>
	    <td align="center"><input name="activity[][order]" type="text" size="3" value="|-if $activity->getOrder() neq $defaultOrder-||-$activity->getOrder()-||-/if-|" |-$readonly|readonly-|></td>
|-if !$construction-|            <td><input name="activity[][startingDate]"  id="activity|-$activity->getId()-|_startingDate" type="text" value="|-$activity->getStartingDate()|date_format-|" size="12" title="Fecha de inicio en formato dd-mm-aaaa" |-$readonly|readonly-| class="dateValidation">|-/if-||-*|-if !$show && !$showLog-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('activity|-$activity->getId()-|_startingDate', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha de inicio">|-/if-|*-|</td>
            <td><input name="activity[][endingDate]"  id="activity|-$activity->getId()-|_endingDate" type="text" value="|-$activity->getEndingDate()|date_format-|" size="12" title="Fecha de finalización en formato dd-mm-aaaa" |-$readonly|readonly-| class="dateValidation">|-*|-if !$show && !$showLog-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('activity|-$activity->getId()-|_endingDate', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha de inicio">|-/if-|*-|</td>
      <td align="center"><input name="activity[][priority]" type="hidden" value="0"><input name="activity[][priority]" type="checkbox" value="1" |-$activity->getPriority()|checked_bool-| |-$readonly|readonly-|></td>
	    <td align="center"><input name="activity[][priorityPercentage]" type="text" size="5" value="|-$activity->getPriorityPercentage()-|" |-$readonly|readonly-|></td>
            <td><input name="activity[][realStart]"  id="activity|-$activity->getId()-|_realStart" type="text" value="|-$activity->getRealStart()|date_format-|" size="12" title="Fecha de inicio real en formato dd-mm-aaaa" |-$readonly|readonly-| class="dateValidation"></td>
            <td><input name="activity[][realEnd]"  id="activity|-$activity->getId()-|_realStart" type="text" value="|-$activity->getRealend()|date_format-|" size="12" title="Fecha de de finalización real en formato dd-mm-aaaa" |-$readonly|readonly-| class="dateValidation"></td>
	    <td align="center"><input name="activity[][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_total[]" type="checkbox" value="1" |-$activity->getAcomplished()|checked_bool-| title="Indique si se completó la actividad" |-$readonly|readonly-|>
			|-if !$show && !$showLog-|<td><a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconAttach" onclick="loadAddDocumentsLightbox(|-$activity->getId()-|)" value="Administrar documentos" title="Administrar documentos" /></a></td>
        </td>
         		<td><input name="activity[][eol]" type="hidden" value="1">|-if !isset($construction) || (isset($construction) && !$construction->getConstructionType() eq 2)-|<input type="button" class="icon iconDelete" title="Eliminar" value="Eliminar" onClick="removeActivity('|-$activity->getId()-|')" />|-else-|<img src="images/clear.png" class="disabled icon iconClear" />|-/if-|</td>|-/if-| 
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
<script type="text/javascript">
function deleteActivityRow(i){
	document.getElementById('activitiesTable').deleteRow(i)
}
</script>
|-include file="PlanningDocumentsLightbox.tpl"-|

|-if !$jqueryAndNoConflictAdded-|<script type="text/javascript" src="scripts/jquery.min.js"></script>|-/if-|
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.js"></script>
<link href="scripts/fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
|-assign var="defaultOrder" value=999-|
|-if !$show && !$showLog-|
<div id="activityMsgField"></div>
<script language="JavaScript" type="text/JavaScript">
	|-if !$jqueryAndNoConflictAdded-|jQuery.noConflict();|-/if-|
	
function addActivity(a) {
	var div = $$("#activityEdit div:first")[0];
	$(a).insert({
		before: "<div>"+div.innerHTML+"</div>"
	});
	return false;
}
function addActivityRow() {
	var ms = new Date().getTime();
	var row = document.createElement('tr');
html =   '      <tr> '
 + '      <td>&nbsp;</td>'
 + '      <td><input name="activity['+ ms +'][name]"  id="params_name[]" type="text" value="" class="width30em" title="Actividad"></td>'
 + '      <td><input name="activity['+ ms +'][order]"  id="params_order[]" type="text" value="" class="width3em" title="Orden" ></td>'
|-if !$construction-| + '        <td><input name="activity['+ ms +'][startingDate]"  id="params_startingDate[]" type="text" value="" title="Fecha de inicio en formato dd-mm-aaaa" class="dateValidation"></td>'|-/if-|
 + '      <td><input name="activity['+ ms +'][endingDate]"  id="params_endingDate[]" type="text" value="" title="Fecha de finalización en formato dd-mm-aaaa" class="dateValidation"></td>'
 + '      <td align="center"><input name="activity['+ ms +'][priority]" type="hidden" value="0"><input name="activity[][priority]" id="params_priority[]" type="checkbox" value="1" title="Indique si es prioritaria"></td>'
 + '      <td align="center"><input name="activity['+ ms +'][priorityPercentage]" id="params_priorityPercentage[]" type="text" value="" class="width3em" title="Indique el porcentaje de la prioridad"></td>'
|-if !$construction-| + '      <td><input name="activity['+ ms +'][rescheduledStart]" id="params_rescheduledStart[]" type="text" title="Fecha de inicio reprogramado en formato dd-mm-aaaa" class="dateValidation" |-if !$loginUser->mayFollow()-|readonly=readonly|-/if-|></td>'|-/if-|
 + '      <td><input name="activity['+ ms +'][rescheduledEnd]" id="params_rescheduledEnd[]" type="text" title="Fecha de finalización reprogramada en formato dd-mm-aaaa" class="dateValidation" |-if !$loginUser->mayFollow()-|readonly=readonly|-/if-|></td>'
 + '      <td><input name="activity['+ ms +'][realStart]" id="params_realStart[]" type="text" value="" title="Fecha de inicio real en formato dd-mm-aaaa" class="dateValidation"></td>'
 + '      <td><input name="activity['+ ms +'][realEnd]" id="params_realEnd[]" type="text" value="" title="Fecha de finalización real en formato dd-mm-aaaa" class="dateValidation"></td>'
 + '      <td align="center"><input name="activity['+ ms +'][acomplished]" type="hidden" value="0"><input name="activity[][acomplished]" id="params_acomplished[]" type="checkbox" value="1" title="Indique si se completó la actividad"></td>'
 + '      <td align="center"><input type="button" class="disabled icon iconAttach" title="Para anexar documentos primero debe guardar la actividad" /></td>'
 + '      <td><input name="activity['+ ms +'][eol]" type="hidden" value="1"><input type="button" class="icon iconDelete" title="Eliminar partida" onclick="deleteActivityRow(this.parentNode.parentNode.rowIndex)" /></td> '
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
          <th colspan="14">|-if !$construction-||-if $showGantt && $activities|count gt 0-|
					<input type="button" class="icon iconViewGantt" onClick='window.open("Main.php?do=planningProjectsViewX&showGantt=true&id=|-$planningProject->getid()-|","Gantt","scrollbars=1,width=800,height=600");' value="Ver Gantt" title="Ver Gantt (abre en ventana nueva)" /> Ver Gantt |-else-|<img src="images/clear.png" class="icon iconClear disabled" />|-/if-||-else-|
					|-if $showGantt && $activities|count gt 0-|<input type="button" class="icon iconViewGantt" onClick='window.open("Main.php?do=planningConstructionsViewX&showGantt=true&id=|-$construction->getid()-|","Gantt","scrollbars=1,width=800,height=600");' value="Ver Gantt" title="Ver Gantt (abre en ventana nueva)" /> Ver Gantt |-else-|<img src="images/clear.png" class="icon iconClear disabled" />|-/if-||-/if-|
					|-if !$show && !$showLog-|<div class="rightLink"><a href="#" onclick="return addActivityRow()" class="addLink" title="Agregar nueva actividad">Agregar Actividades</a></div>
				|-/if-|</th> 
        </tr> 
				|-*if ($show || $showLog) && $activities|@count gt 0*-|
         <tr> 
         <th>&nbsp;</th>
          <th>Nombre</th> 
          <th>Orden</th> 
|-if !$construction-|          <th> Fecha de Inicio Planificada</th> 
          <th>Fecha de Fin Planificada</th> 
|-else-|
          <th>Fecha Planificada</th> 
|-/if-|
          <th>Prioritaria</th>
	  			<th>% de Prioridad</th>
|-if !$construction-|          <th> Fecha estimada de inicio</th> 
          <th> Fecha estimada finalización  </th> 
|-else-|
          <th>Fecha estimada</th>
|-/if-|
|-if !$construction-|          <th>F. inicio real</th> 
          <th>Fecha Finalizada</th> 
|-else-|
          <th>Fecha Finalizada</th>
|-/if-|
         <th>Cumplida</th> 
           |-if !$show && !$showLog-|<th>&nbsp;</th> 
         <th>&nbsp;</th>|-/if-| 
        </tr> 
       </thead> 
      <tbody id="activitiesTbody">  
|-if isset($construction) && $construction->getConstructionType() eq 2-|    <tr> 
      <th colspan="12">Elaboración del proyecto</th> 
    </tr> 
    <tr> 
      <th colspan="12">Por Concurso</th> 
    </tr> 
|-else if isset($construction)-|
    <tr> 
      <th colspan="12">Diseño del Proyecto</th> 
    </tr> 
|-/if-|
 |-foreach from=$activities item=activity name=for_contractActivitys-|
|-if isset($construction) && $construction->getConstructionType() eq 2 && $activity->getName() eq "Diseño del Proyecto"-|
    <tr> 
      <th colspan="12">Diseño Propio</th> 
    </tr> 
|-else if isset($construction) && $construction->getConstructionType() eq 2 && $activity->getName() eq "Presentación EIA en APRA"-|
    <tr> 
      <th colspan="12">Evaluación del impacto Ambiental</th> 
    </tr> 
|-else if isset($construction) && $activity->getName() eq "Aprobación de Pliegos"-|
    <tr> 
      <th colspan="12">Licitación</th> 
    </tr> 
|-/if-|
		<tr id="activityId_|-$activity->getId()-|"> 
			<td><img src="images/clear.png" class="|-if $semaphore-|smallIcon flag|-$activity->statusColor()|capitalize-||-else-|icon iconClear|-/if-|"></a></td>
			<td><input type="hidden" name="activity[|-$activity->getId()-|][id]" value="|-$activity->getId()-|"/>
			|-if isset($construction) && $construction->getConstructionType() eq 2-|<input name="activity[|-$activity->getId()-|][name]" id="params_name[]" type="text" value="|-$activity->getName()|escape-|" title="Actividad" class="width30em" readonly="readonly"></td>
			|-else-|<input name="activity[|-$activity->getId()-|][name]" id="params_name[]" type="text" value="|-$activity->getName()|escape-|" title="Actividad" |-$readonly|readonly:"width30em"-|>|-/if-|</td>
		<td align="center"><input name="activity[|-$activity->getId()-|][order]" type="text" class="width3em" value="|-if $activity->getOrder() neq $defaultOrder-||-$activity->getOrder()-||-/if-|" |-$readonly|readonly-| style="width:3.0em !Important"></td>
|-if !$construction-|            <td><input name="activity[|-$activity->getId()-|][startingDate]" id="activity|-$activity->getId()-|_startingDate" type="text" value="|-$activity->getStartingDate()|date_format:"%d-%m-%Y"-|" title="Fecha en formato dd-mm-aaaa" |-$readonly|readonly-| class="dateValidation" style="width:5.2em !Important"></td>|-/if-|
            <td><input name="activity[|-$activity->getId()-|][endingDate]"  id="activity|-$activity->getId()-|_endingDate" type="text" value="|-$activity->getEndingDate()|date_format:'%d-%m-%Y'-|" title="Fecha en formato dd-mm-aaaa" |-$readonly|readonly-| class="dateValidation" style="width:5.2em !Important"></td>
      <td align="center"><input name="activity[|-$activity->getId()-|][priority]" type="hidden" value="0"><input name="activity[|-$activity->getId()-|][priority]" type="checkbox" value="1" |-$activity->getPriority()|checked_bool-| |-$readonly|readonly-|></td>
	    <td align="center"><input name="activity[|-$activity->getId()-|][priorityPercentage]" type="text" class="width3em" value="|-$activity->getPriorityPercentage()-|" |-$readonly|readonly-|></td>
|-if !$construction-|            <td><input name="activity[|-$activity->getId()-|][rescheduledStart]" id="activity|-$activity->getId()-|_rescheduledStart" type="text" value="|-$activity->getrescheduledStart()|date_format:"%d-%m-%Y"-|" title="Fecha en formato dd-mm-aaaa" |-if !$loginUser->mayFollow()-|readonly=readonly|-else-||-$readonly|readonly-||-/if-| class="dateValidation" style="width:5.2em !Important"></td>|-/if-|
            <td><input name="activity[|-$activity->getId()-|][rescheduledEnd]"  id="activity|-$activity->getId()-|_rescheduledEnd" type="text" value="|-$activity->getrescheduledEnd()|date_format:'%d-%m-%Y'-|" title="Fecha de fin reprogramada en formato dd-mm-aaaa" |-if !$loginUser->mayFollow()-|readonly=readonly|-else-||-$readonly|readonly-||-/if-| class="dateValidation" style="width:5.2em !Important"></td>
|-if !$construction-|            <td><input name="activity[|-$activity->getId()-|][realStart]"  id="activity|-$activity->getId()-|_realStart" type="text" value="|-$activity->getRealStart()|date_format:'%d-%m-%Y'-|" title="Fecha en formato dd-mm-aaaa" |-$readonly|readonly-| class="dateValidation" style="width:5.2em !Important"></td>|-/if-|
            <td><input name="activity[|-$activity->getId()-|][realEnd]"  id="activity|-$activity->getId()-|_realEnd" type="text" value="|-$activity->getRealend()|date_format:'%d-%m-%Y'-|" title="Fecha en formato dd-mm-aaaa" |-$readonly|readonly-| class="dateValidation" style="width:5.2em !Important"></td>
	    <td align="center"><input name="activity[|-$activity->getId()-|][acomplished]" type="hidden" value="0"><input name="activity[|-$activity->getId()-|][acomplished]" id="params_total[]" type="checkbox" value="1" |-$activity->getAcomplished()|checked_bool-| title="Indique si se completó la actividad" |-$readonly|readonly-|>
			|-if !$show && !$showLog-|<td><a id="fancybox_|-$activity->getId()-|" href="Main.php?do=planningActivityDocumentsListX&id=|-$activity->getId()-|" class="iframe lbOn"><input type="button" class="icon iconAttach" onclick="jQuery('a#fancybox_|-$activity->getId()-|').fancybox({'width' : 800, 'height' : 600});" value="Administrar documentos" title="Administrar documentos" /></a></td>
        </td>
         		<td><input name="activity[|-$activity->getId()-|][eol]" type="hidden" value="1">|-if !isset($construction) || (isset($construction) && $construction->getConstructionType() eq 2) || (isset($construction) && $construction->getConstructionType() eq 1)-|<input type="button" class="icon iconDelete" title="Eliminar" value="Eliminar" onClick="removeActivity('|-$activity->getId()-|')" />|-else-|<img src="images/clear.png" class="disabled icon iconClear" />|-/if-|</td>|-/if-| 
       </tr> 
      |-/foreach-|
      </tbody> 
     </table> 
</div> 
<script type="text/javascript">
	
	function openF(id){
		jQuery('a#' + id).fancybox({'width' : '600'});
	}
	jQuery('a#various5').fancybox({'width' : '600'});
	
function deleteActivityRow(i){
	document.getElementById('activitiesTable').deleteRow(i)
}
</script>

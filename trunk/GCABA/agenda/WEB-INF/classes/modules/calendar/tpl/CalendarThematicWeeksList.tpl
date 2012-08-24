<h2>Agenda</h2>
<h1>Administración de Semanas Temáticas</h1>
<p>A continuación se muestra la lista de semásnas temáticas según los ejes de gestión cargados en el sistema.</p>
<div id="div_weeks"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Semana guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Semana eliminada correctamente</div>
	|-/if-|
	<table id="tabla-tipos" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
			<tr class="thFillTitle">
			  <th width="10%">Semana</th> 
				<th width="20%">Desde - Hasta</th>
				<th width="55%">Eje de Gestión</th> 
				<!--<th width="2%">&nbsp;</th> -->
			</tr> 
	  </thead> 
	<tbody id="thematicWeekList">|-if $thematicWeekColl|@count eq 0-|
		<tr>
			 <td colspan="3">|-if isset($filter)-|No hay semanas que concuerden con la búsqueda|-else-|No hay semanas disponibles - 
			 	<input type='button' onClick='location.href="Main.php?do=calendarThematicWeeksList&createYearWeeks=2012"' value='Crear semanas 2012' title="Crear semanas 2012"/>
			 |-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$thematicWeekColl item=thematicWeek name=for_weeks-|
		<tr>
		  <td>|-$thematicWeek->getWeekNumber()-| _ |-$thematicWeek->getYear()-|</td> 
		  <td>|-$thematicWeek->getMonday()|date_format-| a |-$thematicWeek->getSunday()|date_format-| </td> 
			<td>|-if "calendarThematicWeeksEdit"|security_has_access-|
				<span id="media_type_|-$thematicWeek->getid()-|" class="in_place_editable">|-$thematicWeek->getSelectedAxis()-|</span>
				<select id="media_type_|-$thematicWeek->getid()-|_chosen" style="display:none" class="markets-chz-select">
					|-foreach $calendarAxes as $axis-|
						<option value="|-$axis->getId()-| |-$thematicWeek->getAxisId()|selected:$axis->getId()-|">|-$axis->getName()-|</option>
					|-/foreach-|
				</select>
				|-else-||-$thematicWeek->getSelectedAxis()-|
			|-/if-|</td>
			<!--<td nowrap>|-if "calendarThematicWeeksEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="calendarThematicWeeksEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$thematicWeek->getid()-|" /> 
					<input type="submit" name="submit_go_edit_type" value="Editar" title="Editar" class="icon iconEdit" /> 
				</form> |-/if-|
			</td> -->
		</tr> 
		|-/foreach-|
		<tr>
	  </tbody> 
        <tfoot>
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="3" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
       </tfoot>
|-/if-|     </table> 
</div>

<script type="text/javascript">
Ajax.InPlaceEditor.prototype.__enterEditMode = Ajax.InPlaceEditor.prototype.enterEditMode;
Object.extend(Ajax.InPlaceEditor.prototype, {
  enterEditMode:function(e) {
    this.__enterEditMode(e);
    this.triggerCallback('onFormReady',this._form);
  }
});

var axisIdToNameMap;

window.onload = function() {

axisIdToNameMap = |-$axisIdToNameMap-|;
	
|-foreach from=$thematicWeekColl item=thematicWeek name=for_weeks-|
	Event.observe(
		$('media_type_|-$thematicWeek->getId()-|'),
		'mouseover',
		function() { this.addClassName('in_place_hover') }
	);
	Event.observe(
		$('media_type_|-$thematicWeek->getId()-|'),
		'mouseout',
		function() { this.removeClassName('in_place_hover') }
	);
	Event.observe(
		$('media_type_|-$thematicWeek->getId()-|'),
		'click',
		function() { this.hide(); $('media_type_|-$thematicWeek->getId()-|_chosen').show().focus(); }
	);
	Event.observe(
		$('media_type_|-$thematicWeek->getId()-|_chosen'),
		'blur',
		function() {
			updateAxis(this, |-$thematicWeek->getId()-|);
		}
	);
|-/foreach-|
}

function updateAxis(select, thematicWeekId) {
	new Ajax.Request(
		'Main.php?do=commonDoEditFieldX',
		{
			method: 'post',
			parameters: {
				objectType: 'thematicWeek',
				objectId: thematicWeekId,
				paramName: 'axisId',
				paramValue: encodeURIComponent(select.value)
			},
			onSuccess: function(transport) {
				$('media_type_'+thematicWeekId).innerHTML = axisIdToNameMap[parseInt(transport.responseText)];
			}
		}
	);
	select.hide();
	$('media_type_'+thematicWeekId).show();
}

function showInput(to_show, to_hide) {
    $(to_show).show();
    $(to_hide).hide();
}

</script>

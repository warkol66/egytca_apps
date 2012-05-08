<script type="text/javascript" language="javascript" charset="utf-8">
// <![CDATA[
	function hideAll() {
		$('communeIndicatorOptions').hide();
		$('regionIndicatorOptions').hide();
	}
	
	function showCommune() {
		$('communeIndicatorOptions').show();
		$('regionIndicatorOptions').hide();
	}
	
	function showRegion() {
		$('regionIndicatorOptions').show();
		$('communeIndicatorOptions').hide();
	}
// ]]>
</script>

|-if isset($show)-|
<h3><a href="Main.php?do=tableroObjectivesShow">|-$dependency->getName()-|</a> > <a href="Main.php?do=tableroProjectsShow&objectiveId=|-$objective->getid()-|">|-$objective->getName()-|</a> > <a href="Main.php?do=tableroProjectsDetailsShow&projectId=|-$project->getId()-|">|-$project->getName()-|</a> </h3>
|-/if-|
<h2>Tablero de Control</h3>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Indicador</h1>
<div id="div_indicator">
	<form name="form_edit_indicator" id="form_edit_indicator" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el indicador</div>
		|-/if-|
		<p> <a href="#" onClick="javascript:history.go(-1)">Volver atras</a> </p>
		<p> Ingrese los datos del indicator. </p>
		<fieldset title="Formulario de edición de datos de un indicator">
		|-if $action eq "create"-|
		<p>
			<label>Tipo de Indicador</label>
		<ul>
			<li>
				<input type="radio" name="indicatorType" value="normal" onClick="javascript:hideAll()" checked="checked">
				General
				</input>
			</li>
			<li>
				<input type="radio" name="indicatorType" value="commune" onClick="javascript:showCommune()">
				Por comuna
				</input>
			</li>
			<li>
				<input type="radio" name="indicatorType" value="region"  onClick="javascript:showRegion()">
				Por Barrio
				</input>
			</li>
		</ul>
		</p>
		<div id="communeIndicatorOptions" style="display: none;">
			<label>Seleccion las Comunas para las que desea crear los indicadores</label>
			<ul>
				|-foreach from=$communes item=commune name=for_communes-|
				<li>
					<input type="checkbox" name="commune[]" value="|-$commune->getId()-|" >
					|-$commune->getName()-|
					</input>
				</li>
				|-/foreach-|
			</ul>
		</div>
		<div id="regionIndicatorOptions" style="display: none;">
			<label>Seleccion los Barrios para las que desea crear los indicadores</label>
			<ul>
				|-foreach from=$regions item=region name=for_regions-|
				<li>
					<input type="checkbox" name="region[]" value="|-$region->getId()-|" >
					|-$region->getName()-|
					</input>
				</li>
				|-/foreach-|
			</ul>
		</div>
		<p> |-/if-|
			
			|-if $loginUser neq "" and $loginUser->isAdmin()-|
			<label for="indicatorData[projectId]">Proyecto</label>
			<select id="indicatorData[projectId]" name="indicatorData[projectId]" title="projectId" |-if $accion eq "Edición"-|readonly="readonly" |-/if-|>
      	|-foreach from=$projectId_valores item=item_valor name=for_valores-|
					<option value="|-$item_valor->getId()-|" |-if isset($indicator)-||-if $indicator->getprojectId() eq $item_valor->getId()-|selected="selected" |-/if-||-/if-|>|-$item_valor->getName()|truncate:75:"...":false-|</option>
				|-/foreach-|
			</select>
			|-/if-|
			|-if $loginAffiliateUser neq ""-|
			|-if $action eq 'edit'-|
			<input type="hidden" name="indicatorData[projectId]" value="|-$indicator->getprojectId()-|"/>
			|-/if-|
			|-if $action eq "create"-|
			<input type="hidden" name="indicatorData[projectId]" value="|-$project->getId()-|"/>
			|-/if-|
			|-/if-| </p>
		<p> |-if $action eq 'edit'-|
			
			|-if $indicator->isForCommune() eq true-|
		<div id="communeIndicatorOptions" >
			<label> Comuna del Indicador</label>
			|-if $loginUser neq "" and $loginUser->isAdmin()-|
			<select name="indicatorData[communeId]">
		|-foreach from=$communes item=commune name=for_communes-|
				<option value="|-$commune->getId()-|" |-if $commune->getId() eq $indicator->getCommuneId()-|selected="selected"|-/if-|>|-$commune->getName()-|</option>
		|-/foreach-|
		|-/if-|
		|-if $loginAffiliateUser neq ""-|
				<input type="hidden" name="indicatorData[communeId]" value="|-$indicator->getCommuneId()-|" />
			|-assign var=commune value=$indicator->getCommune()-|
			|-$commune->getName()-|<br />
				
		|-/if-|
		
			</select>
		</div>
		|-/if-|
		|-if $indicator->isForRegion() eq true-|
		<div id="regionIndicatorOptions" >
			<label>Barrio del Indicador</label>
			|-if $loginUser neq "" and $loginUser->isAdmin()-|
			<select	name="indicatorData[regionId]">
		|-foreach from=$regions item=region name=for_regions-|
				<option value="|-$region->getId()-|" |-if $region->getId() eq $indicator->getRegionId()-|selected="selected"|-/if-|>|-$region->getName()-|</option>
		|-/foreach-|
		|-/if-|
		|-if $loginAffiliateUser neq ""-|
				<input type="hidden" name="indicatorData[regionId]" value="|-$indicator->getRegionId()-|" />
			|-assign var=region value=$indicator->getRegion()-|
			|-$region->getName()-|<br />
		|-/if-|

		
			</select>
		</div>
		|-/if-|
		|-/if-|
		</p>
		<p>
			<label for="indicatorData[name]">Nombre</label>
			<input name="indicatorData[name]" type="text" id="indicatorData[name]" title="name" value="|-$indicator->getname()|escape-|" size="70" />
		</p>
		<p>
			<label for="indicatorData[expirationDate]">Vencimiento</label>
			<input type="text" id="indicatorData[expirationDate]" name="indicatorData[expirationDate]" value="|-$indicator->getexpirationDate()|date_format:"%d-%m-%Y"-|" title="expirationDate" />
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('expirationDate', false, 'ymd', '-');" title="Seleccione la fecha"> </p>
		<p>
			<label for="indicatorData[notes]">Notas</label>
			<br />
			<textarea name="indicatorData[notes]" cols="70" rows="6" wrap="VIRTUAL">|-$indicator->getnotes()|escape-|</textarea>
		</p>
		<p>
			<label for="indicatorData[started]">Iniciada</label>
			<input type="checkbox" name="indicatorData[start]" value="1" |-if $indicator->getstarted() eq '1'-|checked="checked"|-/if-| /> </p>
		</p>
		<p>
			<label for="indicatorData[startDate]">Inicio</label>
			<input type="text" id="indicatorData[startDate]" name="indicatorData[startDate]" value="|-$indicator->getstartDate()|date_format:"%d-%m-%Y"-|" title="startDate" />
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('startDate', false, 'ymd', '-');" title="Seleccione la fecha"> </p>
		<p>
			<label for="indicatorData[endDate]">Fin</label>
			<input type="text" id="indicatorData[endDate]" name="indicatorData[endDate]" value="|-$indicator->getendDate()|date_format:"%d-%m-%Y"-|" title="endDate" />
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('endDate', false, 'ymd', '-');" title="Seleccione la fecha"> </p>
		<p>
			<label for="indicatorData[actualProgress]">Progreso actual </label>
			<input type="text" id="indicatorData[actualProgress]" name="indicatorData[actualProgress]" value="|-$indicator->getactualProgress()-|" title="actualProgress" />
		</p>
		<p>
			<label>Unidad de Medición</label>
			<select name="indicatorData[measureUnitId]">
			|-foreach from=$measureUnits item=measureUnit name=for_measure_units-|
					<option value="|-$measureUnit->getId()-|" |-if $measureUnit->getId() eq $indicator->getMeasureUnitId()-|selected="selected"|-/if-|>|-$measureUnit->getName()-|</option>
			|-/foreach-|
			</select>
		</p>
		<p>
			<label for="indicatorData[startValue]">Valor inicial </label>
			<input type="text" id="indicatorData[startValue]" name="indicatorData[startValue]" value="|-$indicator->getStartValue()-|" title="Valor inicial" />
		</p>
		<p>
			<label for="indicatorData[goalValue]">Valor objetivo </label>
			<input type="text" id="indicatorData[goalValue]" name="indicatorData[goalValue]" value="|-$indicator->getGoalValue()-|" title="Valor objetivo" />
		</p>
		<p> |-if $action eq 'edit'-|
			<input type="hidden" name="id" id="id" value="|-$indicator->getid()-|" />
			|-/if-|
			<input type="hidden" name="action" id="action" value="|-$action-|" />
			<input type="hidden" name="do" id="do" value="tableroIndicatorsDoEdit" />
			|-if isset($show)-|
			<input type="hidden" name="show" value="1" />
			|-/if-|
			<input type="submit" id="button_edit_indicator" name="button_edit_indicator" title="Aceptar" value="Aceptar" />
		</p>
		</fieldset>
	</form>
</div>

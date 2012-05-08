|-if isset($show)-|
<h2> <a href="Main.php?do=tableroObjectivesShow">|-$dependency->getName()-|</a> > 
	<form id="objectiveForm" action="Main.php" method="get"> 
		<input type="hidden" name="do" value="tableroProjectsShow" / > 
		<input type="hidden" name="objectiveId" value="|-$objective->getid()-|" /> 
		<a href="#" onClick="$('objectiveForm').submit()">|-$objective->getName()-|</a> 
	</form> 
> |-$proyect->getName()-| > |-$indicator->getName()-| </h2>
|-/if-|
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Medición</h1> 
<div id="div_measure"> 
	<form name="form_edit_measure" id="form_edit_measure" action="Main.php" method="post">
 		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar la medición</span>|-/if-|
		<p> <a href="#" onClick="javascript:history.go(-1)">Volver atras</a> </p> 
		<p> Ingrese los datos de la medición. </p> 
		<fieldset title="Formulario de edición de datos de un measure"> 
		<p> |-if $loginUser neq "" and $loginUser->isAdmin()-|
			<label for="indicatorId">Indicador</label> 
			<select id="indicatorId" name="indicatorId" title="indicatorId" |-if $accion eq "Edición"-|readonly="readonly" |-/if-|> 
				|-foreach from=$indicatorId_valores item=item_valor name=for_valores-|
				<option value="|-$item_valor->getId()-|" |-if $measure->getindicatorId() eq $item_valor->getId()-|selected="selected" |-/if-|>|-$item_valor->getName()-|</option> 
				|-/foreach-|
			</select> 
			|-/if-| |-if $loginAffiliateUser neq ""-|
			<input type="hidden" name="indicatorId" value="|-$measure->getIndicatorId()-|" /> 
			|-/if-| </p> 
		<p> 
			<label for="measureDate">Fecha de Medición</label> 
			<input type="text" id="measureDate" name="measureDate" value="|-if $action eq 'edit'-||-$measure->getmeasureDate()|date_format-||-/if-|" title="measureDate" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('measureDate', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha"> </p> 
		<p> 
			<label for="measureNumber">Valor Medición</label> 
			<input name="measureNumber" type="text" id="measureNumber" title="measureNumber" value="|-if $action eq 'edit'-||-$measure->getmeasureNumber()-||-/if-|" size="12" /> 
		</p> 
		<p> 
			<label for="measureExpectedNumber">Valor Esperado de la Medición</label> 
			<input name="measureExpectedNumber" type="text" id="measureExpectedNumber" title="measureExpectedNumber" value="|-if $action eq 'edit'-||-$measure->getmeasureExpectedNumber()-||-/if-|" size="12" /> 
		</p> 
		<p> 
			<label for="notes">Notas</label> 
			<!--<input type="text" id="notes" name="notes" value="|-if $action eq 'edit'-||-$measure->getnotes()-||-/if-|" title="notes" />--> 
			<textarea name="notes" cols="70" rows="6" wrap="VIRTUAL" id="notes">|-if $action eq 'edit'-||-$measure->getnotes()-||-/if-|</textarea> 
		</p> 
		<p> |-if $action eq 'edit'-|
			<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$measure->getid()-||-/if-|" /> 
			|-/if-|
			<input type="hidden" name="action" id="action" value="|-$action-|" /> 
			<input type="hidden" name="do" id="do" value="tableroMeasuresDoEdit" /> 
			|-if isset($show)-|
			<input type="hidden" name="show" value="1" /> 
			|-/if-|
			<input type="submit" id="button_edit_measure" name="button_edit_measure" title="Aceptar" value="Aceptar" /> 
		</p> 
		</fieldset> 
	</form> 
</div>

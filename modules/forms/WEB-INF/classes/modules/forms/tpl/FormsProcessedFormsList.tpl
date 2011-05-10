<h2>Formularios</h2>
<h1>Respuestas de Formularios</h1>
<div id="div_processedforms">
	|-if $message eq "ok"-|
		<div class="successMessage">Respuesta guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Respuesta eliminada correctamente</div>
	|-/if-|
<!--	<h3><a href="Main.php?do=formsProcessedFormsEdit">Agregar ProcessedForm</a></h3>-->
<form action="Main.php" method="get">
	<fieldset title="Formulario de Opciones de búsqueda de respuestas a formularios">
		<legend>Opciones de Búsqueda</legend>
		<p>
			<label for="formId">Formulario</label>
			<select name='filters[formId]' id="formId">
					<option value=''>Seleccione un formulario</option>
				|-foreach from=$forms item=form name=from_forms-|
					<option value="|-$form->getId()-|" |-if $filters neq '' and $filters.formId eq $form->getId()-|selected="selected"|-/if-|>|-$form->getName()-|</option>
				|-/foreach-|
			</select>
		</p>		
		<p>
			<label for="fromDate">Fecha Desde</label>
			<input name="filters[fromDate]" type="text" id="fromDate" title="fromDate" value="|-$filters.fromDate|date_format:"%d-%m-%Y"-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[fromDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		</p>
		<p>
			<label for="toDate">Fecha Hasta</label>
			<input name="filters[toDate]" type="text" id="toDate" title="toDate" value="|-$filters.toDate|date_format:"%d-%m-%Y"-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('filters[toDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		</p>
		<p>
			<input type="hidden" name="do" value="formsProcessedFormsList" />
			<input type="submit" value="Buscar">
		</p>
	</fieldset>
</form>
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="table-processedforms">
		<thead>
			<tr>
				<th>id</th>
				<th>Formulario</th>
				<th>Fecha</th>
				<th>Desde IP</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$processedforms item=processedform name=for_processedforms-|
			<tr>
				<td>|-$processedform->getid()-|</td>
				<td>|-assign var=form value=$processedform->getform()-||-$form->getName()-|</td>
				<td>|-$processedform->getformFillingDate()|change_timezone|date_format:"%d-%m-%Y %R"-|</td>
				<td>|-$processedform->getip()-|</td>
				<td>
					<form action="Main.php" method="get">
						<input type="button" class="buttonImageView" onClick="window.open('Main.php?do=formsProcessedFormView&id=|-$processedform->getid()-|','Respuestas','width=670,height=500,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes');" value="Ver respuesta" title="Ver respuesta">
					</form>
	<!--				<form action="Main.php" method="get">
						<input type="hidden" name="do" value="formsProcessedFormsEdit" />
						<input type="hidden" name="id" value="|-$processedform->getid()-|" />
						<input type="submit" name="submit_go_edit_processedform" value="Editar" title="Editar" class="buttonImageEdit" />
					</form> -->
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="formsProcessedFormsDoDelete" />
						<input type="hidden" name="id" value="|-$processedform->getid()-|" />
						<input type="submit" name="submit_go_delete_processedform" value="Eliminar" title="Eliminar" class="buttonImageDelete" onclick="return confirm('Seguro que desea eliminar el processedform?')"  />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="5" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
		</tbody>
	</table>
</div>

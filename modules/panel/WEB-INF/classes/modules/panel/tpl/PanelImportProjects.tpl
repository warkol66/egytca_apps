<h2>Tablero de Gestión</h2>
<h1>Importación de Contratos y Actividades</h1>
<p>A continuación se presenta el formulario de importación de datos del SEPA. Seleccione un responsable y un subcomponente para asignar por defecto para los contratos que no estén cargados en el sistema.<br />
Los contratos que estén cargados, serán actualizados con los datos del archivo que se importe al sistema.</p>
|-if $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error.</div>
|-elseif $message eq 'projectError'-|
    <div class="failureMessage">
		<ul>
		|-foreach from=$project->getValidationFailures() item=error-|
			<li>|-$error->getMessage()-|</li>
		|-/foreach-|
		</ul>
	</div>
|-elseif $message eq 'invalidFile'-|
	<div class="failureMessage">El archivo seleccionado es invalido.</div>
|-elseif $message eq 'catDocError'-|
	<div class="failureMessage">Error al leer el archivo.</div>
|-elseif $message eq 'success'-|
	<div class="successMessage">Se importaron los datos.</div>
|-/if-|
<fieldset>
<form method="post" action="Main.php?do=panelDoImportProjects" enctype="multipart/form-data" >
	<p>
		<label for="project_params_responsible_code">Responsable</label>
		<select id="project_params_responsible_code" name="projectParams[responsibleCode]" title="Responsable del Proyecto" |-$project|propelValidatorError:"responsibleCode"-|> 
	    	<option value="">Seleccione Responsable</option>
			|-foreach from=$positions item=position name=for_positions-|
        		<option value="|-$position->getCode()-|" |-$project->getResponsibleCode()|selected:$position->getCode()-|>|-$position->getOwnerName()-| &#8212; |-assign var=tenure value=$position->getActiveTenure()-| |-if $tenure->getObject() != NULL-||-assign var=tenureObject value=$tenure->getObject()-||-$tenureObject->getName()-| |-$tenureObject->getSurname()-||-/if-|</option> 
			|-/foreach-|
      	</select><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
	</p>
	<p>
		<label for="project_params_objective_id">Sub-componente</label>
		<select id="project_params_objective_id" name="projectParams[objectiveId]" title="objectiveId" |-$project|propelValidatorError:"objectiveId"-|>
			<option value="">Seleccione objetivo</option>
			|-foreach from=$objectives item=objective name=for_valores-|
        		<option value="|-$objective->getId()-|" |-$project->getobjectiveId()|selected:$objective->getId()-|>|-$objective->getName()|truncate:75:"...":false-|</option> 
			|-/foreach-|
		</select><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
	</p>
	<p>
		<label for="file">Seleccione un archivo</label>
		<input type="file" id="file" name="file" />
	</p>
	<input type="submit" value="Enviar" />
</form>
</fieldset>
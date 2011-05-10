|-include file='ValidationJavascriptInclude.tpl'-|
	<form name="form_edit_activity" id="form_edit_activity" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de una actividad">
			<p>																								
			<label for="params[projectId]">##projects,1,Proyecto##</label>
			<select id="params[projectId]" name="params[projectId]" title="##projects,1,Proyecto##" |-$action|disabled-|>
				<option value="">Seleccione un ##projects,4,proyecto##</option>
				|-foreach from=$projects item=project name=for_projects-|
				<option value="|-$project->getId()-|" |-if $activity->getprojectId() eq $project->getId()-|selected="selected" |-/if-|>|-$project->getName()|escape|truncate:75:"...":false-|</option>
				|-/foreach-|
			</select>
			</p>
			<p>
				<label for="params[name]">Actividad</label>
				<input type="text" id="params[name]" name="params[name]" size="70" value="|-$activity->getname()|escape-|" title="Nombre de la actividad" |-$action|readonly-| />
			</p>
			<p>
				<label for="params[plannedStart]">Inicio planificado</label>
				<input type="text" id="paramsProject_plannedStart" name="params[plannedStart]" value="|-$activity->getplannedStart()|date_format:"%d-%m-%Y"-|" title="Fecha de inicio planificado (Formato: dd-mm-yyyy)" |-$action|readonly-| class="dateValidation" |-javascript_onchange_validation_attribute idField="paramsProject_plannedStart"-|/>
				|-if $action ne "showLog"-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[plannedStart]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">&nbsp;&nbsp;|-/if-|
			</p>
			<p>
				<label for="params[realStart]">Inicio Real</label>
				<input type="text" id="paramsProject_realStart" name="params[realStart]" value="|-$activity->getrealStart()|date_format:"%d-%m-%Y"-|" title="Fecha de inicio real (Formato: dd-mm-yyyy)" |-$action|readonly-| class="dateValidation" |-javascript_onchange_validation_attribute idField="paramsProject_realStart"-|/>
				|-if $action ne "showLog"-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[realStart]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">&nbsp;&nbsp;|-/if-|
			</p>
			<p>
				<label for="params[plannedEnd]">Fin Planificado</label>
				<input type="text" id="paramsProject_plannedEnd" name="params[plannedEnd]" value="|-$activity->getplannedEnd()|date_format:"%d-%m-%Y"-|" title="Fecha de planificada de finalización (Formato: dd-mm-yyyy)" |-$action|readonly-| class="dateValidation" |-javascript_onchange_validation_attribute idField="paramsProject_plannedEnd"-|/>
				|-if $action ne "showLog"-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[plannedEnd]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">&nbsp;&nbsp;|-/if-|
			</p>
			<p>
				<label for="params[realEnd]">Fin real</label>
				<input type="text" id="paramsProject_realEnd" name="params[realEnd]" value="|-$activity->getrealEnd()|date_format:"%d-%m-%Y"-|" title="Fecha de real de finalización (Formato: dd-mm-yyyy)" |-$action|readonly-| class="dateValidation" |-javascript_onchange_validation_attribute idField="paramsProject_realEnd"-|/>
				|-if $action ne "showLog"-|<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[realEnd]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">&nbsp;&nbsp;|-/if-|
			</p>
			<p>
				<label for="params[completed">Completada</label>
				|-if $action eq "showLog"-|
    				<span>|-$activity->getCompleted()|yes_no|multilang_get_translation:"common"-|</span>
    			|-else-|
					<input type="hidden" name="params[completed]" id="params[completed]" value="0" />
					<input type="checkbox" name="params[completed]" title="Marque si está terminada la actividad" |-$activity->getCompleted()|checked_bool-| />
				|-/if-|
			</p>
			<p>
				<label for="params[notes]">Notas</label>
				<textarea name="params[notes]" id="params[notes]" title="Notas" rows="5" cols="70" |-$action|readonly-|>|-$activity->getNotes()|escape-|</textarea>
			</p>
			<p>
			|-if $action ne "showLog"-|
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$activity->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="projectsActivitiesDoEdit" />
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if isset($show)-|								
					<input type="hidden" name="show" value="1" />
				|-/if-|								
				<input type="submit" id="button_edit_activity" name="button_edit_activity" title="Aceptar" value="Guardar" />
				|-if $fromProjectId-|
				<input type="submit" id="button_add_more" name="button_add_more" title="Guardar y crear otra" value="Guardar y crear otra" />
				<input type="hidden" name="fromProjectId" id="fromProjectId" value="|-$fromProjectId-|" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=projectsList'"/>
				|-else-|								
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=projectsActivitiesList'"/>
				|-/if-|
			|-/if-|								
			</p>
		</fieldset>
	</form>
<script language="JavaScript" type="text/javascript">
	infoElement = $("status_info");
	if (infoElement !== null) infoElement.hide();
</script>
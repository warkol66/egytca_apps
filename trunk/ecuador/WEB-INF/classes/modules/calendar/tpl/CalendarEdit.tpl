<script src="Main.php?do=js&name=js&module=calendar&code=|-$currentLanguageCode-|" type="text/javascript"></script>
|-include file='CalendarEventsEditTinyMceInclude.tpl' elements="params_body" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
|-popup_init src="scripts/overlib.js"-|
|-if !is_object($calendarEvent)-|
<div>Evento no encontrado, puede que haya sido eliminado o esté incorrectamente identificado.<br />
Puede regresar a la página principal del calendario haciendo click <a href="Main.php?do=calendarList">aquí</a></div>
|-else-|
<h2>Administración de Eventos</h2>
<h1>|-if !$calendarEvent->isNew()-|Editar|-else-|Crear|-/if-| Evento</h1>
|-if $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar el evento</div>
|-/if-|
<script type="text/javascript">
	$(document).ready(function() {
		$.datepicker.setDefaults(jQuery.datepicker.regional['es']);
        $( ".datepicker" ).datepicker({
			dateFormat:"dd-mm-yy"
		});
		$( ".datepickerStart" ).datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerEnd").datepicker("option", "minDate", selectedDate);
            }
		});
        $( ".datepickerEnd" ).datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerStart").datepicker("option", "maxDate", selectedDate);
            }
		});

	});//fin docready
 
</script>
<div id="div_calendarEvents">
	|-$calendarEvent->getstartdate|date_format-|
		<form name="form_edit_calendarEvent" id="form_edit_calendarEvent" action="Main.php" method="post">
			<p>Ingrese los datos del evento</p>
			<fieldset title="Formulario de edición de datos de un evento">
			<legend>Formulario de Calendario de Eventos</legend>
				<p>
					<label for="calendarEvent_title">Título</label>
					<input name="params[title]" type="text" id="params_title" title="title" value="|-$calendarEvent->getTitle()|escape-|" size="60" maxlength="255" />
				</p>
|-if $calendarEventsConfig.useSummary.value eq "YES"-|<p>
					<label for="calendarEvent_summary">Resumen</label>
					<textarea name="params[summary]" cols="60" rows="4" wrap="VIRTUAL" id="params_summary">|-$calendarEvent->getsummary()|escape-|</textarea>
				</p>|-/if-|
				<p>
					<label for="calendarEvent_body">Texto del Evento</label>
					<textarea name="params[body]" cols="60" rows="15" wrap="VIRTUAL"  id="params_body">|-$calendarEvent->getbody()|htmlentities-|</textarea>
			</p>
				<p>
|-if $calendarEventsConfig.useSource.value eq "YES"-|<label for="calendarEvent_sourceContact">Más información</label>
					<input name="params[sourceContact]" type="text" id="params_sourceContact" title="sourceContact" value="|-$calendarEvent->getsourceContact()|escape-|" size="60" maxlength="150" />
				</p>|-/if-|
				<p>
					<label for="calendarEvent_creationDate">Fecha de Creación</label>
					<input name="params[creationDate]" type="text" id="params_creationDate" class="datepicker" title="creationDate" value="|-$calendarEvent->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>
				<p>
					<label for="calendarEvent_startDate">Fecha de Inicio Actividad</label>
					<input name="params[startDate]" type="text" id="params_startDate" class="datepickerStart" title="startDate" value="|-$calendarEvent->getstartDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>
				<p>
					<label for="calendarEvent_endDate">Fecha de Fin Actividad</label>
					<input name="params[endDate]" type="text" id="params_endDate" class="datepickerEnd" title="endDate" value="|-$calendarEvent->getendDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
					<a href="#" |-popup sticky=true caption="Fechas de la agenda" trigger="onMouseOver" text="Las fechas deben completarse para que el evento se registre correctamente.<br />La fecha de creación ubicará el evento por orden descendente en la página principal, las fechas de inicio y fin de la actividad le indican al sistema la vigencia del mismo." snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a>
				</p>							
				|-assign var=eventid value=$calendarEvent->getId()-|
				|-if not empty($eventid)-|
				<p>
					<label for="calendarEvent_status">Estado</label>
					<select name="params[status]">
						|-foreach from=$calendarEventStatus key=key item=name-|
							<option value="|-$key-|" |-if ($calendarEvent->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
						|-/foreach-|
					</select>
				</p>|-/if-|
|-if $calendarEventsConfig.useRegions.value eq "YES"-|<p>
					<label for="calendarEvent_regionId">Provincia</label>
					<select id="params_regionId" name="params[regionId]" title="regionId">
						<option value="">Seleccione una Provincia</option>
										|-foreach from=$regionIdValues item=object-|
										<option value="|-$object->getid()-|" |-if $calendarEvent->getregionId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
										|-/foreach-|
									</select>
			</p>|-/if-|
|-if $calendarEventsConfig.useCategories.value eq "YES"-|<p>
					<label for="calendarEvent_categoryId">Categoría</label>
					<select id="params_categoryId" name="params[categoryId]" title="categoryId">
						<option value="">Seleccione una Categoría</option>
										|-foreach from=$categoryIdValues item=object-|
										<option value="|-$object->getid()-|" |-if $calendarEvent->getcategoryId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
										|-/foreach-|
									</select>
			</p>|-/if-|
				<p>
					<label for="calendarEvent_userId">Usuario</label>
					<select id="params_userId" name="params[userId]" title="userId">
						<option value="">Seleccione un Usuario</option>
										|-foreach from=$userIdValues item=object-|
										<option value="|-$object->getid()-|" |-if $calendarEvent->getuserId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getusername()-|</option>
										|-/foreach-|
									</select>
			</p>
				<p>
					|-if !$calendarEvent->isNew()-|
					<input type="hidden" name="id" id="id" value="|-$calendarEvent->getid()-|" />
					|-/if-|
					
					<!--pasaje de parametros de filtros -->
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					
					<input type="hidden" name="action" id="action" value="|-$action-|" />
					<input type="hidden" name="do" id="doEdit" value="calendarDoEdit" />
					<input type="button" id="button_edit_calendarEvent" name="button_edit_calendarEvent" title="Aceptar" value="Aceptar" onClick="javascript:submitEventCreation(this.form)"  />
|-if $calendarEventsConfig.bodyOnEventsShow.value eq "YES"-|
					<input type="button" id="button_edit_calendarEvent" name="button_edit_calendarEvent" title="Aceptar" value="Vista previa del evento" onClick="javascript:submitEventsPreviewDetailed(this.form)"  />
|-else-|
<input type="button" id="button_edit_calendarEvent" name="button_edit_calendarEvent" title="Aceptar" value="Vista previa en Home" onClick="javascript:submitEventsPreviewOnHome(this.form)"/>
					<input type="button" id="button_edit_calendarEvent" name="button_edit_calendarEvent" title="Aceptar" value="Vista previa del Detalle" onClick="javascript:submitEventsPreviewDetailed(this.form)"  />
|-/if-|
				</p>
			</fieldset>
		</form>
	</div>
|-if $calendarEventsConfig.useImages.value eq "YES" || $calendarEventsConfig.useAudio.value eq "YES" || $calendarEventsConfig.useVideo.value eq "YES"-|
	<div id="mediasListHolder">
		|-include file='CalendarMediasListInclude.tpl'-|
	</div>
	|-if !$calendarEvent->isNew()-|
		|-include file='CalendarMediasAddInclude.tpl' calendarEvent=$calendarEvent-|
	|-/if-|
	|-/if-|
|-/if-|

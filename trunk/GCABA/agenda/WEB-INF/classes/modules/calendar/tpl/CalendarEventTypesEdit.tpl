<h2>Agenda</h2>
<h1>Administración de Formatos de evento</h1>
<p>A continuación puede modificar los tipos de formatos de evento de la agenda.</p>
<div id="div_axes"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Formato guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Formato eliminado correctamente</div>
	|-/if-|
|-if !$notValidId-|	

<div id="div_eventType">
	<form name="form_edit_eventType" id="form_edit_eventType" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un eje de gestión">
			<p>
				<label for="params_name">Nombre</label>
				<input type="text" id="params_name" name="params[name]" value="|-$eventType->getName()|escape-|" title="name" maxlength="255" />
			</p>
			<p>
				|-if !$eventType->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$eventType->getId()-|" />
				|-/if-|
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				<input type="hidden" name="do" id="do" value="calendarEventTypesDoEdit" />
				<input type="submit" id="button_edit_eventType" name="button_edit_eventType" title="Aceptar" value="Aceptar" />
				<input type='button' onClick='location.href="Main.php?do=calendarEventTypesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='Cancelar' title="Regresar al listado de Formatos"/>
			</p>
		</fieldset>
	</form>
</div>
|-else-|
<div class="errorMessage">El identificador del eje ingresado no es válido. Seleccione un eje de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=calendarEventTypesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Formatos"/>
|-/if-|
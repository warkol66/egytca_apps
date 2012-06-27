<h2>Agenda</h2>
<h1>Administración de Ejes de Gesti&oacute;n </h1>
<p>A continuación puede modificar los tipos de ejes de gesti&oacute;n de la agenda.</p>
<div id="div_axes"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Eje guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Eje eliminado correctamente</div>
	|-/if-|
|-if !$notValidId-|	

<div id="div_calendarAxis">
	<form name="form_edit_calendarAxis" id="form_edit_calendarAxis" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un eje de gestión">
			<p>
				<label for="params_name">Nombre</label>
				<input type="text" id="params_name" name="params[name]" value="|-$calendarAxis->getName()|escape-|" title="name" maxlength="255" />
			</p>
			<p>
				<label for="params_description">Descripción</label>
				<textarea id="params_description" name="params[description]">|-$calendarAxis->getDescription()|escape-|</textarea>
			</p>
			<p>
				<label for="params_color">Color</label>
				<input type="text" id="params_color" name="params[color]" value="|-$calendarAxis->getColor()|escape-|" title="Color" maxlength="12" />
			</p>
			<p>
				<label for="params_cssClass">Clase css</label>
				<input type="text" id="params_cssClass" name="params[cssClass]" value="|-$calendarAxis->getCssClass()|escape-|" title="Clase de los eventos" />
			</p>
			<p>
				<label for="params_tabClass">Clase de la pestaña</label>
				<input type="text" id="params_tabClass" name="params[tabClass]" value="|-$calendarAxis->getTabClass()|escape-|" title="Clase de la pestaña" />
			</p>
			<p>
				|-if !$calendarAxis->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$calendarAxis->getId()-|" />
				|-/if-|
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				<input type="hidden" name="do" id="do" value="calendarAxisDoEdit" />
				<input type="submit" id="button_edit_calendarAxis" name="button_edit_calendarAxis" title="Aceptar" value="Aceptar" />
				<input type='button' onClick='location.href="Main.php?do=calendarAxisList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='Cancelar' title="Regresar al listado de Ejes"/>
			</p>
		</fieldset>
	</form>
</div>
|-else-|
<div class="errorMessage">El identificador del eje ingresado no es válido. Seleccione un eje de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=calendarAxisList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Ejes"/>
|-/if-|
<h2>Configuración del Sistema</h2>
<h1>Administrar Formularios</h1>

|-if $notValidId-|
<div class="errorMessage">El identificador del formulario ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=profilesFormList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratos"/>
|-else-|

<p>A continuación puede agregar un formulario completando los campos del mismo. Al finalizar, haga click en "Guardar" para almacenar el formulario en el sistema.</p>
<form method="post">
<fieldset>
<legend>Datos del Formulario</legend>
<p><label for="params[name]">Nombre</label><input name="params[name]" type="text" class="emptyValidation" id="params[name]" value="|-$form->getName()|escape-|" size="45" /> |-validation_msg_box idField="params[name]"-|</p>
<p><label for="params[description]">Formulario de relaciones</label><input type="hidden" value="0" name="params[relationship]" /><input type="checkbox" value="1" name="params[relationship]" |-$form->getRelationship()|checked_bool-| /></p>
<p><label for="params[description]">Descripción</label><textarea name="params[description]" id="params[description]" cols="45" rows="6" wrap="VIRTUAL">|-$form->getDescription()|escape-|</textarea>
</p>|-if $form->isNew()-|
<p>Para completar la creación del formulario, debe ingresar el nombre de la sección de inicio del formulario.</p>
<p><label for="sectionTitle">Sección de inicio</label><input name="sectionTitle" type="text" class="emptyValidation" id="sectionTitle" value="" size="25" /> |-validation_msg_box idField="sectionTitle"-|</p>|-/if-|
<p>&nbsp;</p>
<p><input type="hidden" name="do" value="profilesFormDoEdit">
	|-if !$form->isNew()-|<input type="hidden" name="id" value="|-$form->getId()-|">|-/if-|
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		 <p>
			|-javascript_form_validation_button value='Guardar' title='Guardar'-|
	|-include file="HiddenInputsInclude.tpl"-|
	<input type="button" value="Regresar" onClick="location.href='Main.php?do=profilesFormList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'" /></p>
</fieldset>
</form>
|-/if-|
<h2>Medios</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| tipo</h1>
<div id="div_type">
	<p>Ingrese los datos del tipo de medio</p>
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el tipo</span>|-/if-|
	<form name="form_edit_type" id="form_edit_type" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un tipo">
			<legend>Formulario de Administración de tipos de medio</legend>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="20" value="|-$mediaType->getName()|escape-|" title="Nombre" />
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$mediaType->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="mediasTypeDoEdit" />
				<input type="submit" id="button_edit_type" name="button_edit_type" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=mediasTypeList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>
</div>

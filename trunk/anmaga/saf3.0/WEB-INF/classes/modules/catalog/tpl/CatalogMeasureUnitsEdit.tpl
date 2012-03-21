<h2>Configuración</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Unidad de Medida</h1>
<div id="div_measureunit">
	<form name="form_edit_measureunit" id="form_edit_measureunit" action="Main.php" method="post">
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar la unidad de medida</span>|-/if-|
		<p>
			Ingrese los datos de la unidad de medida measure unit.
		</p>
		<fieldset title="Formulario de edición de datos de un measure unit">
		<legend>Unidad de Medida</legend>
			<p>
				<label for="name">Nombre</label>
				<input type="text" id="name" name="name" value="|-if $action eq 'edit'-||-$measureunit->getname()-||-/if-|" title="name" maxlength="255" />
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$measureunit->getid()-||-/if-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="catalogMeasureUnitsDoEdit" />
				<input type="submit" id="button_edit_measureunit" name="button_edit_measureunit" title="Aceptar" value="Aceptar" />
			<input type='button' onClick='location.href="Main.php?do=catalogMeasureUnitsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de unidades"/>
			</p>
		</fieldset>
	</form>
</div>

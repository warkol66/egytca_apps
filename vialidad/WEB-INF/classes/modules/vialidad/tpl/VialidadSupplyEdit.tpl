<h2>Insumos</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Insumo</h1>
<div id="div_supply">
	<p>Ingrese los datos del Insumo</p>
	|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el Insumo</span>|-/if-|
	<form name="form_edit_supply" id="form_edit_supply" action="Main.php" method="post">
		<fieldset title="Formulario de edici&oacute;n de datos de un Insumo">
			<legend>Formulario de Administraci&oacute;n de Insumos</legend>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="10" value="|-$supply->getName()|escape-|" title="Nombre" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$supply->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="vialidadSupplyDoEdit" />
				<input type="submit" id="button_edit_supply" name="button_edit_supply" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=vialidadSupplyList'"/>
			</p>
		</fieldset>
	</form>
</div>

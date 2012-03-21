<h2>Catálogo</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Unidad de Venta </h1>
<div id="div_unit"> 
	<form name="form_edit_unit" id="form_edit_unit" action="Main.php" method="post">
 		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar la unidad</span>|-/if-|
		<p>Ingrese los datos de la unidad. </p> 
		<fieldset title="Formulario de edición de datos de un unit"> 
		<legend>Unidad de Venta</legend>
		<p> 
			<label for="name">Nombre</label> 
			<input name="name" type="text" id="name" size="20" value="|-if $action eq 'edit'-||-$unit->getname()-||-/if-|" title="name" maxlength="255" /> 
		</p> 
		<p> 
			<label for="name">Cantidad por unidad</label> 
			<input name="unitQuantity" type="text" id="unitQuantity" size="15" value="|-if $action eq 'edit'-||-$unit->getUnitQuantity()-||-/if-|" title="unitQuantity" maxlength="255" /> 
		</p> 
		<p> |-if $action eq 'edit'-|
			<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$unit->getid()-||-/if-|" /> 
			|-/if-|
			<input type="hidden" name="action" id="action" value="|-$action-|" /> 
			<input type="hidden" name="do" id="do" value="catalogUnitsDoEdit" /> 
			<input type="submit" id="button_edit_unit" name="button_edit_unit" title="Aceptar" value="Aceptar" /> 
			<input type='button' onClick='location.href="Main.php?do=catalogUnitsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de unidades"/>
		</p> 
		</fieldset> 
	</form> 
</div>

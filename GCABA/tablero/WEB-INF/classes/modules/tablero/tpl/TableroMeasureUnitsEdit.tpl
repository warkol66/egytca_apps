<h2>Configuración de Tablero de Control</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Unidad de Medida</h1>
<div id="div_measureunit">
	<form name="form_edit_measureunit" id="form_edit_measureunit" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el measure unit</div>
		|-/if-|
		<p>
			Ingrese los datos de la unidad de medida
		</p>
		<fieldset title="Formulario de edición de datos de unidad de medida">
			<p>
				<label for="measureUnit[name]">Nombre</label>
				<input name="measureUnit[name]" type="text" id="measureUnit[name]" value="|-if $action eq 'edit'-||-$measureunit->getname()|escape-||-/if-|" size="25" />
			</p>
			<p>
				<label for="measureUnit[abbreviation]">Abreviatura</label>
				<input name="measureUnit[abbreviation]" type="text" id="measureUnit[abbreviation]" value="|-if $action eq 'edit'-||-$measureunit->getAbbreviation()|escape-||-/if-|" size="8" />
			</p>
			<p>
				<label for="measureUnit[format]">Formato</label>
				<input name="measureUnit[format]" type="text" id="measureUnit[format]" value="|-if $action eq 'edit'-||-$measureunit->getFormat()|escape-||-/if-|" size="8" />
			</p>
<!--<p><select id="measureUnit[type]" name="measureUnit[type]" title="type">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$measureTypes key=typeKey item=type name=for_type-|
			|-if $action eq "edit"-|
        <option value="|-$typeKey-|"|-if $measureunit->getFormat() eq $typeKey-| selected="selected"|-/if-|>|-$type-|</option>
				|-else-|
        <option value="|-$typeKey-|">|-$type-|</option>
				|-/if-|
			|-/foreach-|
			</select></p>-->
<p>				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-if $action eq "edit"-||-$measureunit->getid()-||-/if-|" />
				|-/if-|
				</select>
				|-if $page gt 1-| <input type="hidden" name="page" id="page" value="|-$page-|" />|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="tableroMeasureUnitsDoEdit" />
				<input type="submit" id="button_edit_measureunit" name="button_edit_measureunit" title="Aceptar" value="Aceptar" />
				<input type="button" id="button_return" name="button_return" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=tableroMeasureUnitsList|-if $page gt 1-|&page=|-$page-||-/if-|'""/>
			</p>
		</fieldset>
	</form>
</div>

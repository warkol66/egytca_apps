<h2>Configuración del Sistema</h2>
<h1>Administración de Carteleras</h1>
<div id="div_billboard">
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar la Cartelera</span>|-/if-|
<fieldset title="Formulario de edición de datos de un billboard">
	<form name="form_edit_billboard" id="form_edit_billboard" action="Main.php" method="post">
		<p>Ingrese los datos de la Cartelera a |-if $action eq "edit"-|Editar|-else-|Crear|-/if-|</p>
		
			<legend>Cartelera</legend>
			<p>
				<label for="billboard[number]">Número</label>
				<input type="text" id="billboard[number]" name="number" value="|-$billboard->getnumber()-|" title="number" />
			</p>
			<p>
				<label for="billboard[type]">Tipo</label>
				<select id="type" name="billboard[type]">
					<option value="">Seleccione un Tipo</option>
					<option value="1"|-if $billboard->getType() eq "1"-|selected="selected" |-/if-|>Doble</option>
					<option value="2"|-if $billboard->getType() eq "2"-|selected="selected" |-/if-|>Séxtuple</option>
				</select>									
			</p>
			<p>
				<label for="billboard[height]">En Altura</label>
				<input type="checkbox" id="height" name="billboard[height" value="1"|-if $billboard->getheight() eq '1'-| checked="checked"|-/if-| />
			</p>
			<p>
				<label for="billboard[row]">Fila</label>
				<input type="text" id="row" name="billboard[row]" value="|-$billboard->getrow()-|" title="row" />
			</p>
			<p>
				<label for="billboard[column]">Columna</label>
				<input type="text" id="column" name="billboard[column]" value="|-$billboard->getcolumn()-|" title="column" />
			</p>
			<p>
				<label for="billboard[addressId]">Dirección</label>
				<select id="addressId" name="billboard[addressId]" title="addressId">
					<option value="">Seleccione una Dirección</option>
					|-foreach from=$addressIdValues item=object-|
						<option value="|-$object->getid()-|" |-if $billboard->getaddressId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				
				|-if isset($listRedirect)-|
					|-if isset($listRedirect.circuitId)-|
						<input type="hidden" name="listRedirect[circuitId]" value="|-$listRedirect.circuitId-|"></input>
					|-/if-|
					|-if isset($listRedirect.regionId)-|
						<input type="hidden" name="listRedirect[regionId]" value="|-$listRedirect.regionId-|"></input>
					|-/if-|
					|-if isset($listRedirect.rating)-|
						<input type="hidden" name="listRedirect[rating]" value="|-$listRedirect.rating-|"></input>
					|-/if-|
					|-if isset($listRedirect.streetName)-|
						<input type="hidden" name="listRedirect[streetName]" value="|-$listRedirect.streetName-|"></input>
					|-/if-|
					|-if isset($listRedirect.page)-|
						<input type="hidden" name="listRedirect[page]" value="|-$listRedirect.page-|"></input>
					|-/if-|					
				|-/if-|	
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-$billboard->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="lausiBillboardsDoEdit" />
				<input type="submit" id="button_edit_billboard" name="button_edit_billboard" title="Aceptar" value="Aceptar" />
				

				<form action="LausiBillboardsEdit_cancel" method="get" >
		
					|-if isset($listRedirect)-|
						|-if isset($listRedirect.circuitId)-|
							<input type="hidden" name="listRedirect[circuitId]" value="|-$listRedirect.circuitId-|"></input>
						|-/if-|
						|-if isset($listRedirect.regionId)-|
							<input type="hidden" name="listRedirect[regionId]" value="|-$listRedirect.regionId-|"></input>
						|-/if-|
						|-if isset($listRedirect.rating)-|
							<input type="hidden" name="listRedirect[rating]" value="|-$listRedirect.rating-|"></input>
						|-/if-|
						|-if isset($listRedirect.streetName)-|
							<input type="hidden" name="listRedirect[streetName]" value="|-$listRedirect.streetName-|"></input>
						|-/if-|
						|-if isset($listRedirect.page)-|
							<input type="hidden" name="listRedirect[page]" value="|-$listRedirect.page-|"></input>
						|-/if-|
					|-/if-|					

					<input type="button" name="button_cancel_edit_billboard" value="Cancelar" id="button_cancel_edit_billboard" onClick="javascript:history.back();" />
			</p>
				</form>
				</fieldset>
	</form>
</div>

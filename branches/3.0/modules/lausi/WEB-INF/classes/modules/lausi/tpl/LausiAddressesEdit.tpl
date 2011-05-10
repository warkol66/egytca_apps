<h2>Administración de Direcciones</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Dirección</h1>
<p>A continuación se muestra el formulario de datos de direcciones. Para ingresar una nueva dirección, escriba en el campo "Calle" el nombre o parte del nombre, y en "Número" la altura y pulse el botón "Buscar en mapa". El sistema le mostrará la dirección que mas se ajusta a los valores ingresados. Para direcciones con intersección o donde no se tenga el dato preciso, puede solicitar el Buscar en mapa&quot; para una dirección cercana, y mover manualmente el marcador hasta la ubicación de la cartelera.</p>
<div id="div_address">
|-if $message eq "created"-|
	<div class="successMessage">Direccion creada correctamente, puede editar sus carteleras en la seccion inferior</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar la dirección</div>
|-/if-|
	<fieldset title="Formulario de edición de datos de una dirección">
	<legend>Dirección</legend>
	<form name="form_edit_address" id="form_edit_address" action="Main.php" method="post">
		<p>
			Ingrese los datos de la dirección
		</p>
			<p>
				<label for="address[street]">Calle</label>
				<input name="address[street]" type="text" id="street" title="street" value="|-$address->getstreet()-|" size="45" maxlength="100" onChange="$('button_edit_address').disable()" />
			</p>
			<p>
				<label for="address[number]">Número</label>
				<input name="address[number]" type="text" id="number" title="number" value="|-$address->getnumber()-|" size="12" onChange="$('button_edit_address').disable()" />
			</p>
			<p>
				<label for="address[intersection]">Intersección</label>
				<input name="address[intersection]" type="text" id="intersection" title="intersection" value="|-$address->getintersection()-|" size="45" maxlength="100" onChange="$('button_edit_address').disable()" />
			</p>
			<p><input type="button" id="button_locate" value="Buscar en mapa" title="Buscar en Mapa" onClick="addressMap.locate(this.form); $('button_edit_address').enable()"/>
			</p>
			<p>
				<label for="address[nickname]">Nombre De Fantasía</label>
				<input name="address[nickname]" type="text" id="number" title="number" value="|-$address->getNickname()-|" size="45" />
			</p>			
			<p>
				<input name="address[latitude]" type="hidden" id="latitude" title="latitude" value="|-$address->getlatitude()|system_numeric_format:8-|" size="20" />
			</p>
			<p>
				<input name="address[longitude]" type="hidden" id="longitude" title="longitude" value="|-$address->getlongitude()|system_numeric_format:8-|" size="20" />
			</p>
			<p>
				<label for="address[regionId]">Barrio</label>
				<select id="regionId" name="address[regionId]" title="regionId" onChange="$('button_edit_address').disable()">
					<option value="">Seleccione un Barrio</option>
									|-foreach from=$regions item=object-|
									<option value="|-$object->getid()-|" |-if $address->getregionId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
									|-/foreach-|
								</select>
		</p>
			<p>
				<label for="address[circuitId]">Circuito</label>
				<select id="circuitId" name="address[circuitId]" title="circuitId">
					<option value="">Seleccione un Circuito</option>
									|-foreach from=$circuits item=object-|
									<option value="|-$object->getid()-|" |-if $address->getcircuitId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
									|-/foreach-|
								</select>
		</p>
			<p>
				<label for="address[owner]">Dueño</label>
				<input name="address[owner]" type="text" id="owner" title="owner" value="|-$address->getowner()-|" size="45" maxlength="100" />
			</p>
			<p>
				<label for="address[ownerPhone]">Tel. Dueño</label>
				<input name="address[ownerPhone]" type="text" id="ownerPhone" title="ownerPhone" value="|-$address->getownerPhone()-|" size="30" maxlength="100" />
			</p>
		<p>
				<label for="address[rating]">Valoración</label>
					<select name="address[rating]" id="rating" >
						<option value="0" |-0|selected:$address->getRating()-|>Seleccione Valoración</option>
						<option value="1" |-1|selected:$address->getRating()-|>Premium</option>
						<option value="2" |-2|selected:$address->getRating()-|>Superior</option>
						<option value="3" |-3|selected:$address->getRating()-|>Destacada</option>
						<option value="4" |-4|selected:$address->getRating()-|>Standart</option>
					</select>
		</p>
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-$address->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="lausiAddressesDoEdit" />

				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				<input type="submit" id="button_edit_address" name="button_edit_address" title="Aceptar" value="Aceptar" |-if $address->getId() eq ''-|disabled|-/if-|/>
				<input type='button' onClick='location.href="Main.php?do=lausiAddressesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='Cancelar' title="Regresar al listado de carteleras"/>
		</p>
	</form>
	
	|-include file="LausiAddressesMapInclude.tpl" -|
	
	</fieldset>	
	
	
	
|-if isset($listRedirect) || $address->getId() ne ''-|

	<p>&nbsp;</p>
	<h2>|-$address->getName()-|</h2>
	<h1>Carteleras y Motivos en la Dirección</h1>
	<form action="Main.php" method="get">
			|-include file="FiltersRedirectInclude.tpl"-|
			<input type="hidden" name="addressId" value="|-$address->getId()-|" id="addressId" />
			<input type="hidden" name="do" value="lausiAdvertisementsEdit" />
			<input type="submit" value="Crear Aviso en Dirección" />
	</form>

|-/if-|

|-if isset($billboards)-|
	<form action="Main.php" method="get">
		|-include file="FiltersRedirectInclude.tpl"-|
		<input type="hidden" name="addressId" value="|-$address->getId()-|" id="addressId">
		<input type="hidden" name="do" value="lausiBillboardsList">
		<input type="submit" value="Editar Carteleras de la Dirección">
	</form>
	<h3>Motivos en la Dirección</h3>
	<fieldset>
		<ul>
			|-if $groupByTheme|@count gt 0-|
			|-foreach from=$groupByTheme item=item-|
			<li>|-assign var=theme value=$item.theme-|<strong>|-$theme->getName()-|</strong> - Cantidad de |-if $theme->getType() eq 1-|Módulos Dobles|-/if-||-if $theme->getType() eq 2-|Séxtuples|-/if-|: |-$item.adverts|@count-|<br />&nbsp;&nbsp;&nbsp;Desde: |-$theme->getStartDate()|date_format:"%d-%m-%Y"-| - Hasta: |-$theme->getEndDate()|date_format:"%d-%m-%Y"-| </li>
			|-/foreach-|
		|-else-|
		<li>No hay motivos asignados</li>
		|-/if-|
		</ul>
	</fieldset>
	<h3>Disponibilidad de Carteleras</h3>
	<p>
		|-include file="LausiBillboardsAvailableTodayInclude.tpl"-|
	</p>
	<h3>Agregar Avisos en la Dirección</h3>
	<p>
		|-include file="LausiAddAdvertOnAddressInclude.tpl"-|
	</p>	
	<h3>Agregar Carteleras a la Dirección</h3>
	<p>
		|-include file="LausiBillboardManager.tpl"-|
	</p>
|-/if-|

</div>

<h2>Banners</h2>
<h1>|-if $zone->getId() ne ''-|Editar|-else-|Crear|-/if-| Zonas</h1>
<p>A continuación encontrará el formularo de información de las zonas. Ingrese la información solicitada y haga clcik en "Guardar" para conservar los cambios. 
</p>
<form method="post" action="Main.php" id="form1">
	<fieldset title="Formulario de edición de datos de zonas">
	<legend>Datos de la Zona</legend>
		<p>
			<label for="name">Nombre</label>
			<input type="text" size="35" name="zone[name]" value="|-$zone->getName()-|" />
		</p>
		<p>
			<label for="rotationType">Tipo de Rotación</label>
			|-html_options name=zone[rotationType] options=$zone->getRotationTypes() selected=$zone->getRotationType()-|
		</p>
		<p>
			<label for="rows">Filas</label>
			<input type="text" name="zone[rows]" size="5" value="|-$zone->getRows()-|" />
		</p>
		<p>
			<label for="columns">Columnas</label>
			<input type="text" name="zone[columns]" size="5" value="|-$zone->getColumns()-|" />
		</p>
		<p>
			<label for="description">Descripción</label>
			<textarea name="zone[description]" cols="65" rows="4" wrap="virtual">|-$zone->getDescription()-|</textarea>
		</p>
		<p>
			<input type="submit" value="##5,Guardar##" class="button"/>
			<input type="button" value="##6,Regresar##" onClick="history.go(-1)" class="button" />                
		</p>
	</fieldset>    
	<input type="hidden" name="zone[zoneId]" value="|-$zone->getId()-|" />
	<input type="hidden" name="do" value="bannersZonesDoEdit" />
</form>

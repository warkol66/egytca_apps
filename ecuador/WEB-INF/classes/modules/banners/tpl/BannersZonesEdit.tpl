<h2>Banners</h2>
|-if !is_object($bannerZone)-|
<p>La zona especificada no existe</p>
|-else-|
<h1>|-if !$bannerZone->isNew()-|Editar|-else-|Crear|-/if-| Zonas</h1>
<p>A continuación encontrará el formularo de información de las zonas. Ingrese la información solicitada y haga clcik en "Guardar" para conservar los cambios. 
</p>
<form method="post" action="Main.php" id="form1">
	<fieldset title="Formulario de edición de datos de zonas">
	<legend>Datos de la Zona</legend>
		<p>
			<label for="name">Nombre</label>
			<input type="text" size="35" name="params[name]" value="|-$bannerZone->getName()-|" />
		</p>
		<p>
			<label for="rotationType">Tipo de Rotación</label>
			|-html_options name="params[rotationType]" options=$bannerZone->getRotationTypes() selected=$bannerZone->getRotationType()-|
		</p>
		<p>
			<label for="rows">Filas</label>
			<input type="text" name="params[rows]" size="5" value="|-$bannerZone->getRows()-|" />
		</p>
		<p>
			<label for="columns">Columnas</label>
			<input type="text" name="params[columns]" size="5" value="|-$bannerZone->getColumns()-|" />
		</p>
		<p>
			<label for="description">Descripción</label>
			<textarea name="params[description]" cols="65" rows="4" wrap="virtual">|-$bannerZone->getDescription()-|</textarea>
		</p>
		<p>
			<input type="submit" value="##5,Guardar##" class="button"/>
			<input type="button" value="##6,Regresar##" onClick="history.go(-1)" class="button" />                
		</p>
	</fieldset>    
	<input type="hidden" name="id" value="|-$bannerZone->getId()-|" />
	<input type="hidden" name="do" value="bannersZonesDoEdit" />
</form>
|-/if-|

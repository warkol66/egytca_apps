<h2>Configuración</h2>
<h1>Importación de Direcciones</h1>
<p>Esta aplicación le permitirá incorporar las direcciones ingresadas en el CompuMap. Recuerde ingresar la información de circuito y carteleras en los camde comentario. Busque el archivo generado con el CompuMap y haga click en Cargar</p>
<div>
	|-if $message eq "ok"-|
		<div class="message_ok">Direcciones cargadas correctamente</div>
	|-/if-|
	|-if $loaded ne ""-|
		<div class="message_ok">Se han cargado |-$loaded-| direcciones</div>
	|-/if-|
<fieldset>
	<legend>Importar direcciones</legend>
	<form name="form_import_addresses" id="form_import_addresses" action="Main.php" method="post" enctype="multipart/form-data">
			<p>Cargar Direcciones a partir de Archivo CSV </p>
		<p>
			<label for="csv">Archivo CSV </label>
			<input name="csv" type="file" id="csv" size="35" />
		</p>
		<p>
			<input type="hidden" name="do" id="do" value="lausiAddressesImportConfirm" />
			<input type="submit" value="Cargar" class="button" />
		</p>
	</form>
</fieldset>
</div>

<h2>Banners</h2>
|-if !is_object($bannerClient)-|
<p>El cliente especificado no existe</p>
|-else-|
<h1>|-if !$bannerClient->isNew() -|Editar|-else-|Crear|-/if-| Clientes</h1>
<p>A continuación encontrará el formularo de información del cliente. Ingrese la información solicitada y haga clcik en "Guardar" para conservar los cambios. 
</p>
<form method="post" action="Main.php" id="form1">
	<fieldset title="Formulario de edición de datos de clientes">
	<legend>Datos de Clientes</legend>
		<p>
			<label for="name">Nombre</label>
			<input type="text" size="55" name="params[name]" value="|-$bannerClient->getName()-|" />
		</p>
		<p>
			<label for="contactName">Persona contacto</label>
			<input name="params[contactName]" type="text" value="|-$bannerClient->getContactName()-|" size="45" />
		</p>
		<p>
			<label for="phone">Teléfono</label>
			<input name="params[phone]" type="text" value="|-$bannerClient->getPhone()-|" size="35" />
		</p>
		<p>
			<label for="eMail">E-mail</label>
			<input name="params[eMail]" type="text" value="|-$bannerClient->getEMail()-|" size="45" />
		</p>
		<p>
			<label for="webSiteUrl">Sitio Web</label>
			<input name="params[webSiteUrl]" type="text" value="|-$bannerClient->getWebSiteUrl()-|" size="45" />
		</p>
		<p>
			<label for="comments">Comentarios</label>
			<textarea name="params[comments]" cols="55" rows="6" wrap="virtual">|-$bannerClient->getComments()-|</textarea>
		</p>
		<p>
			<input type="submit" value="##5,Guardar##" />
			<input type="button" value="##6,Regresar##" onClick="history.go(-1)" />			    
		</p>
	</fieldset>
	<input type="hidden" name="id" value="|-$bannerClient->getId()-|" />
	<input type="hidden" name="do" value="bannersClientsDoEdit" />
</form>
|-/if-|

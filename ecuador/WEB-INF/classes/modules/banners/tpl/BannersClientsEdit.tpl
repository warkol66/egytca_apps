<h2>Banners</h2>
<h1>|-if $client->getId() ne ''-|Editar|-else-|Crear|-/if-| Clientes</h1>
<p>A continuación encontrará el formularo de información del cliente. Ingrese la información solicitada y haga clcik en "Guardar" para conservar los cambios. 
</p>
<form method="post" action="Main.php" id="form1">
	<fieldset title="Formulario de edición de datos de clientes">
	<legend>Datos de Clientes</legend>
		<p>
			<label for="name">Nombre</label>
			<input type="text" size="55" name="name" value="|-$client->getName()-|" />
		</p>
		<p>
			<label for="contactName">Persona contacto</label>
			<input name="contactName" type="text" value="|-$client->getContactName()-|" size="45" />
		</p>
		<p>
			<label for="phone">Teléfono</label>
			<input name="phone" type="text" value="|-$client->getPhone()-|" size="35" />
		</p>
		<p>
			<label for="eMail">E-mail</label>
			<input name="eMail" type="text" value="|-$client->getEMail()-|" size="45" />
		</p>
		<p>
			<label for="webSiteUrl">Sitio Web</label>
			<input name="webSiteUrl" type="text" value="|-$client->getWebSiteUrl()-|" size="45" />
		</p>
		<p>
			<label for="comments">Comentarios</label>
			<textarea name="comments" cols="55" rows="6" wrap="virtual">|-$client->getComments()-|</textarea>
		</p>
		<p>
			<input type="submit" value="##5,Guardar##" />
			<input type="button" value="##6,Regresar##" onClick="history.go(-1)" />			    
		</p>
	</fieldset>
	<input type="hidden" name="clientId" value="|-$client->getId()-|" />
	<input type="hidden" name="do" value="bannersClientsDoEdit" />
</form>

<h2>##clients,1,Clientes##</h2>
<h1>Administración de Usuarios de ##clients,1,Clientes##</h1>
	<p>A continuación podrá |-if $currentClientUser->getId() eq ''-|crear|-else-|editar|-/if-| el Usuario de ##clients,3,Cliente##|-if $currentClientUser->getClient() ne ''-| de |-$currentClientUser->getClient()-||-/if-|.</p>
	|-if $currentClientUser->getId() eq ''-|
		<p>Ingrese la Identificación del usuario y la contraseña para el nuevo usuario, luego haga click en Guardar para generar el nuevo usuario.</p>
		|-if $ownerCreation ne ''-|
			<p><div class="successMessage">El sistema ha recibido su solicitud.<br />
Para terminar de crear el ##clients,3,Cliente## debe crear una cuenta de usuario asociada.</div></p>
		|-/if-|
	|-else-|
			<p>Realice los cambios en el usuario y haga click en Aceptar para guardar las modificaciones.</p>
	|-/if-| 
|-if $message eq "wrongPassword"-|
	<div class='errorMessage'>Las contraseñas deben coincidir</div>
|-elseif $message eq "emptyClient"-|
	<div class='errorMessage'>Debe selecccionar un cliente</div>
|-elseif $message eq "errorUpdate"-|
	<div class='errorMessage'>Ha ocurrido un error al intentar guardar la información del usuario</div>
|-elseif $message eq "saved"-|
	<div class='errorMessage'>Usuario guardado</div>
|-elseif $message eq "notAddedToGroup"-|
	<div class='errorMessage'>Ha ocurrido un error al intentar agregar el usuario al grupo</div>
|-elseif $message eq "notRemovedFromGroup"-|
	<div class='errorMessage'>Ha ocurrido un error al intentar eliminar el usuario al grupo</div>
|-/if-|
|-if $currentClientUser->getValidationFailures()|@count > 0-|
	<div class="errorMessage">
		<ul>
			|-foreach from=$currentClientUser->getValidationFailures() item=error-|
				<li>|-$error->getMessage()-|</li>
			|-/foreach-|
		</ul>
	</div>
|-/if-|
|-include file='ValidationJavascriptInclude.tpl'-|
<form method="post" action="Main.php">
	<fieldset title="Formulario de edición de usuario">
	<legend>Usuario de ##clients,1,Clientes## |-if $currentClientUser->getClient() ne ''-|- |-$currentClientUser->getClient()-||-/if-|</legend>
		<p>
			<label for="clientUser[username]">Identificación de Usuario</label>
	|-if $action eq 'edit' and $currentClientUser->getUsername() ne ''-|<input id='actualclientUser[username]' type='hidden' value='|-$currentClientUser->getUsername()-|' />|-/if-|
			<input name="clientUser[username]" id="clientUser[username]" type="text"  value="|-$currentClientUser->getUsername()-|" size="40" |-ajax_onchange_validation_attribute actionName=clientsUsersValidationUsernameX-| />|-validation_msg_box idField="clientUser[username]"-|
		</p>
		<p>
			<label for="clientUser[name]">Nombre</label>
			<input name="clientUser[name]" type="text"  value="|-$currentClientUser->getName()-|" size="60" />
		</p>
		<p>
			<label for="clientUser[surname]">Apellido</label>
			<input name="clientUser[surname]" type="text"  value="|-$currentClientUser->getSurname()-|" size="60" />
		</p>
		<p>
			<label for="clientUser[mailAddress]">E-mail</label>
			<input name="clientUser[mailAddress]" id="clientUser[mailAddress]" type="text"  value="|-$currentClientUser->getMailAddress()-|" size="60"  class="mailValidation" onchange="javascript:validationValidateFieldClienSide('clientUser[mailAddress]');" /> |-validation_msg_box idField="clientUser[mailAddress]"-|
		</p>
		<p><label for="pass">##users,165,Contraseña##</label>
			<input id='pass' name='pass' type='password' value='' size="20" class="" onchange="javascript:setElementClass('pass','emptyValidation');setElementClass('pass2','passwordMatch');validationValidateFieldClienSide('pass');" /> |-validation_msg_box idField=pass-|
		</p>
		<p><label for="pass2">##users,166,Repetir Contraseña##</label>
			<input id='pass2' name='pass2' type='password' value='' size="20" class="" onchange="javascript:validationValidateFieldClienSide('pass2');" /> |-validation_msg_box idField=pass2-|
		</p>
|-if $levels|@count gt 0-|		<p>
			<label for="clientUser[levelId]">Nivel de Usuario</label>
	        <select name="clientUser[levelId]">
	        	<option value="">Seleccionar nivel</option>
				|-foreach from=$levels item=level name=for_levels-|
	        		<option value="|-$level->getId()-|" |-$level->getId()|selected:$currentClientUser->getLevelId()-|>|-$level->getName()-|</option>
				|-/foreach-|
	       	</select>
		</p>|-/if-|
		|-if $clients|@count > 0 && $ownerCreation eq ''-|
		<p>
			<label for="clientUser[clientId]">##clients,3,Cliente##</label>
			<select name="clientUser[clientId]">
					<option value="">Seleccione ##clients,3,Cliente##</option>
				|-foreach from=$clients item=client name=for_clients-|
					<option value="|-$client->getId()-|"|-if $client->getId() eq $currentClientUser->getClientId()-| selected="selected"|-/if-|>|-$client->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		|-/if-|
		<p>
			<input type="hidden" name="ownerCreation" value="|-$ownerCreation-|" />
			<input type="hidden" name="id" value="|-$currentClientUser->getId()-|" />
			<input type="hidden" name="do" value="clientsUsersDoEdit" />
			|-javascript_form_validation_button value='##97,Guardar##' title='##97,Guardar##'-|
			<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##' />
		</p>
	</fieldset>
</form>

|-if $currentClientUser->getId() ne '' && $groups|@count gt 0-|
<fieldset title="Formulario de edición de grupos del usuario">
	<legend>El usuario |-$currentClientUser->getUsername()-| es miembro de los grupos:</legend>
	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableTdBorders">
		|-if $currentUserGroups|@count eq 0-|
			<tr>
				<th colspan="2">El usuario todavía no es miembro de ningún grupo.</th>
			</tr>
		|-else-|
			<tr>
				<th width="95%">Grupo</th>
				<th width="5%">&nbsp;</th>
			</tr>
			|-foreach from=$currentUserGroups item=group name=for_user_group-|
			<tr>
				<td width="95%"><div class="titulo2">|-$group->getName()-|</div></td>
				<td width="5%" nowrap>
					<form action="Main.php" method="post" style="display:inline;"> 
						<input type="hidden" name="do" value="clientsUsersDoRemoveFromGroup" /> 
						<input type="hidden" name="group" value="|-$group->getId()-|" /> 
						<input type="hidden" name="user" value="|-$currentClientUser->getId()-|" /> 
						<input type="submit" name="submit_go_delete_client_group" value="##192,Eliminar acceso##" title="Eliminar" class="icon iconDelete" onclick="return confirm('##257,Esta opción remueve el acceso del grupo a la categoría. ¿Está seguro que desea eliminarlo?##');"  /> 
					</form>
				</td>
			</tr>
			|-/foreach-|
		|-/if-|
	</table>
	<p>
		<form action="Main.php" method="post">
			<label for="category">Agregar al Usuario en el Grupo:</label>
			<select name="group">
				<option value="" selected="selected">Seleccionar grupo</option>
				|-foreach from=$groups item=group name=for_groups-|
					<option value="|-$group->getId()-|">|-$group->getName()-|</option>
				|-/foreach-|
			</select>
			<input type="hidden" name="do" value="clientsUsersDoAddToGroup" />
			<input type="hidden" name="user" value="|-$currentClientUser->getId()-|" />
			<input type="submit" value="Agregar" />
		</form>
	</p>
</fieldset>
|-/if-|
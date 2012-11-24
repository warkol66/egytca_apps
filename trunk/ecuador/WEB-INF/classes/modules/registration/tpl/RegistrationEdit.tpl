|-if isset($loggedUser) and get_class($loggedUser) eq "User"-|
<h2>Módulo de Registro de Usuarios</h2>
<h1>Administrar Registro de Usuarios</h1>
|-else-|
<div id="contentBody">
<div id="titleContent">Registro de Usuarios</div>
<p>Si querés recibir nuestro Newsletter semanal que se envía los días jueves, dejá tus datos aquí. 
Si preferís recibir nuestras novedades de manera diaria, te recomendamos te suscribas al servicio <a href="Main.php?do=contentShow&amp;id=4">RSS</a>.</p>
<p>Si tienes problemas con el proceso de registro, por favor, ponte en contacto con nosotros enviando un mail a <a href="mailto:infocivica@poderciudadano.org">infocivica@poderciudadano.org</a></p>

<h1>|-if !$registrationUser->isNew() -|Editar Mi Perfil|-else-|Alta de Usuario de Registro|-/if-|</h1>
|-/if-|


|-if $message eq "error"-|
    |-if $error eq "error_fields"-|
        |-if isset($failures) and is_array($failures)-|
            |-foreach from=$failures item=error-|
        <div class="failureMessage errorMessage">|-$error->getMessage()-|.</div>
            |-/foreach-|
        |-/if-|
    |-elseif $error eq "error_passwd"-|
        <div class="failureMessage errorMessage">Error. Los passwords proporcionados no concuerdan.</div>
    |-elseif $error eq "error_username_used"-|
        <div class="failureMessage errorMessage">El nombre de usuario se encuentra en uso, por favor ingrese uno distinto.</div>
    |-elseif $error eq "error_captcha"-|
        <div class="failureMessage errorMessage">Error en código de validación.</div>
    |-/if-|
|-/if-|
<form method="post" action="Main.php?do=registrationDoEdit"> 
	<fieldset> 
		<legend>
        |-if isset($loggedUser) and get_class($loggedUser) eq "User"-|
            |-if !$registrationUser->isNew() -|Editar|-else-|Crear|-/if-| Usuario Registrado
        |-else-|
            |-if !$registrationUser->isNew() -|Datos de Mi Perfil|-else-|Datos de Registro|-/if-|
        |-/if-|
        </legend>
		<p>Ingrese sus datos</p> 

		|-if not $registrationUser->isNew()-|
		<p>
		<label>Usuario</label>  |-$registrationUser->getUsername()-|
		</p>
        |-else-|
            <p>
                <label for="params[username]">Usuario</label>
                <input type="text" class="emptyValidation" id="params[username]" name="params[username]" size="35" value="|-$registrationUser->getUsername()-|" />
            </p>
		|-/if-|
		<p>
		<label for="registrationUserInfo[mailAddress]">Dirección de Email</label>
			<input type="text" class="emptyValidation" id="registrationUserInfo[mailAddress]" name="registrationUserInfo[mailAddress]" size="35" value="|-if isset($registrationUserInfo)-||-$registrationUserInfo->getMailAddress()-||-/if-||-if $failedRegistrationUserInfo neq ""-||-$failedRegistrationUserInfo.mailAddress-||-/if-|" />
		</p>
		<p>
		<label for="params[password]">Contraseña</label>
			<input type="password" class="emptyValidation" id="params[password]" name="params[password]" size="15" />
		</p> 
		<p>
		<label for="params[check_password]">Reingrese Contraseña</label>
			<input type="password" class="emptyValidation" id="params[check_password]" name="params[check_password]" size="15" />
		</p>
		<p>
		<label for="name">Nombre</label>
			<input type="text" class="emptyValidation" name="registrationUserInfo[name]" size="35"value="|-if isset($registrationUserInfo)-||-$registrationUserInfo->getName()-||-/if-||-if $failedRegistrationUserInfo neq ""-||-$failedRegistrationUserInfo.name-||-/if-|" />
		</p>
        <p>
            <label for="registrationUserInfo[surname]">Apellido</label>
            <input type="text" class="emptyValidation" id="registrationUserInfo[surname]" name="registrationUserInfo[surname]" size="35" value="|-if isset($registrationUserInfo)-||-$registrationUserInfo->getSurname()-||-/if-||-if $failedRegistrationUserInfo neq ""-||-$failedRegistrationUserInfo.surname-||-/if-|" />
        </p>
		<p>
		<label for="registrationUserInfo[alternateMailAddress]">Dirección de Email Alternativa</label>
			<input type="text" id="registrationUserInfo[alternateMailAddress]" name="registrationUserInfo[alternateMailAddress]" size="35" value="|-if isset($registrationUserInfo)-||-$registrationUserInfo->getAlternateMailAddress()-||-/if-||-if $failedRegistrationUserInfo neq ""-||-$failedRegistrationUserInfo.alternateMailAddress-||-/if-|" />
		</p>
		<p>
		<label for="registrationUserInfo[occupation]">Profesión</label>

			<input type="text" id="registrationUserInfo[occupation]" name="registrationUserInfo[occupation]" size="35" value="|-if isset($registrationUserInfo)-||-$registrationUserInfo->getOccupation()-||-/if-||-if $failedRegistrationUserInfo neq ""-||-$failedRegistrationUserInfo.occupation-||-/if-|" />
		</p>
		<p>
		<label for="registrationUserInfo[organization]">Organización</label>
			<input type="text" id="registrationUserInfo[organization]" name="registrationUserInfo[organization]" size="45" value="|-if isset($registrationUserInfo)-||-$registrationUserInfo->getOrganization()-||-/if-||-if $failedRegistrationUserInfo neq ""-||-$failedRegistrationUserInfo.organization-||-/if-|" />
		</p>
		<p>
		<label for="registrationUserInfo[telephone]">Teléfono</label>
			<input type="text" id="registrationUserInfo[telephone]" name="registrationUserInfo[telephone]" size="35" value="|-if isset($registrationUserInfo)-||-$registrationUserInfo->getTelephone()-||-/if-||-if $failedRegistrationUserInfo neq ""-||-$failedRegistrationUserInfo.telephone-||-/if-|" />
		</p>
		<p>
		<label for="registrationUserInfo[alternateTelephone]">Teléfono Alternativo</label>

			<input type="text" id="registrationUserInfo[alternateTelephone]" name="registrationUserInfo[alternateTelephone]" size="35" value="|-if isset($registrationUserInfo)-||-$registrationUserInfo->getAlternateTelephone()-||-/if-||-if $failedRegistrationUserInfo neq ""-||-$failedRegistrationUserInfo.alternateTelephone-||-/if-|" />
		</p>
		<p>
			<label for="registrationUserInfo[group]">Grupo</label>
			<select class="emptyValidation" id="registrationUserInfo[group]"	name="registrationUserInfo[group]">
				|-foreach from=$groups item=group key=key name=for_groups-|
				<option value="|-$key-|" |-if isset($registrationUserInfo) and $key eq $registrationUserInfo->getGroup()-|selected="selected"|-/if-| |-if $failedRegistrationUserInfo neq "" and $failedRegistrationUserInfo.group eq $key-|selected=selected|-/if-|>|-$group-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="registrationUserInfo[country]">Pais</label>
			<select class="emptyValidation" id="registrationUserInfo[country]"	name="registrationUserInfo[country]">
				|-foreach from=$countries item=country name=for_groups-|
				|-if $country eq "separator"-|
					<optgroup label="----------"></optgroup>
				|-else-|
				<option value="|-$country-|" |-if isset($registrationUserInfo) and $country eq $registrationUserInfo->getCountry()-|selected="selected"|-/if-||-if $failedRegistrationUserInfo neq "" and $failedRegistrationUserInfo.country eq $country-|selected=selected|-/if-|>|-$country-|</option>
				|-/if-|
				|-/foreach-|
			</select>
		</p>
		<p>
		<label for="registrationUserInfo[state]">Provincia</label>
			<input type="text" class="emptyValidation" id="registrationUserInfo[state]" name="registrationUserInfo[state]" size="20" value="|-if isset($registrationUserInfo)-||-$registrationUserInfo->getState()-||-/if-||-if $failedRegistrationUserInfo neq ""-||-$failedRegistrationUserInfo.state-||-/if-|" />
		</p>
		|-if isset($admin) and $admin-|
		<p>
				<label for="params[active]">Estado</label>
				<select name="params[active]" id="params[active]>
					<option value="0" |-if isset($registrationUser) and $registrationUser->getActive() eq 0-|selected="selected"|-/if-|>Inactivo</option>
					<option value="1" |-if isset($registrationUser) and $registrationUser->getActive() eq 1-|selected="selected"|-/if-|>Activo</option>
				</select>
		</p>
		|-/if-|
		|-if isset($newsletterActive) and $newsletterActive-|
		<p>
		<label for="newsletterSubscribe">Subscripción a Newsletter</label> 
			<input type="hidden" name="registrationUserInfo[newsletterSubscribe]" value="0" />
			<input type="checkbox" name="registrationUserInfo[newsletterSubscribe]" value="1" |-if isset($registrationUserInfo) and $registrationUserInfo->getNewsletterSubscribe() eq 1-|checked="checked"|-/if-||-if $failedRegistrationUserInfo neq "" and $failedRegistrationUserInfo.newsletterSubscribe eq 1-|checked=checked|-/if-|/>
		</p>
		|-/if-|

		|-if isset($useCaptcha) and $useCaptcha-|
		<p>
			<label for="newsletterSubscribe">Código de Seguridad</label>
				<img src="Main.php?do=registrationCaptchaGeneration&width=120&height=45&characters=5" />
		</p>
		<p>
				Ingrese el código de seguridad de la imagen <br />
				<input id="security_code" name="securityCode" type="text" size="10" />
		</p>

		|-/if-|

		|-if isset($loginRegistrationUser) and $loginRegistrationUser-|
		<p>
		<label for="created">Fecha de registro</label>  |-$registrationUser->getCreated()-|
		</p>
		<p>
		<label for="ip">IP de registro</label>  |-$registrationUser->getIp()-|
		</p>
		|-if $registrationUser->getUpdated() != $registrationUser->getCreated()-|
		<p>
		<label for="created">Fecha última modificación</label>  |-$registrationUser->getUpdated()-|
		</p>
		|-/if-|
		<p>
		<label for="lastLogin">Fecha último ingreso</label>  |-$registrationUser->getLastLogin()-|
		</p>
		|-/if-|

        <script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>

		<p>
			|-if not $registrationUser->isNew() and (not isset($loginRegistrationUser) || not $loginRegistrationUser)-|
				<input type="hidden" name="id" value="|-$registrationUser->getId()-|"/>

			|-/if-|


            |-if isset($loggedUser)-|
                |-javascript_form_validation_button value=Guardar-|
            |-else-|
                |-javascript_form_validation_button value=Guardar-|
            |-/if-|


		</p> 
	</fieldset> 
</form> 
|-if not isset($loggedUser) or get_class($loggedUser) neq "User"-|
</div>
|-/if-|
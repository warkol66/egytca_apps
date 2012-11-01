|-if isset($loginUser)-|
<h2>Registro de Usuarios</h2> 
|-else-|
<div id="contentBody">
<div id="titleContent">Registro de Usuarios</div>
<p>Si querés recibir nuestro Newsletter semanal que se envía los días jueves, dejá tus datos aquí. 
Si preferís recibir nuestras novedades de manera diaria, te recomendamos te suscribas al servicio <a href="Main.php?do=contentShow&amp;id=4">RSS</a>.</p>
<p>Si tienes problemas con el proceso de registro, por favor, ponte en contacto con nosotros enviando un mail a <a href="mailto:infocivica@poderciudadano.org">infocivica@poderciudadano.org</a></p>
|-/if-|
<h1>|-if isset($userByRegistration) or isset($values.user_id)-|Edición de Datos de Usuarios Registrados|-else-|Alta de Usuario de Registro|-/if-|</h1>
|-if $message eq "error_fields"-|
	<div class='failureMessage'>Error. Complete todos los campos correctamente.</div>
|-elseif $message eq "error_passwd"-|
	<div class='failureMessage'>Error. Los passwords proporcionados no concuerdan.</div>
|-elseif $message eq "error_username_used"-|
	<div class='failureMessage'>El nombre de usuario se encuentra en uso, por favor ingrese uno distinto.</div>
|-elseif $message eq "error_captcha"-|
	<div class='failureMessage'>Error en código de validación.</div>
|-/if-|
<form method='post' action="Main.php?do=registrationDoEdit"> 
	<fieldset> 
		<legend>Datos de Registro</legend>
		<p>Ingrese sus datos</p> 

		|-if isset($userByRegistration)-|
		|-assign var=userinfo value=$userByRegistration->getRegistrationUserInfo()-|
		<p>
		<label for="username">Identificación de Usuario</label>  |-$userByRegistration->getUsername()-|
		</p>
		|-/if-|
		<p>

		<label for="email">Dirección de Email *</label> 
			<input type='text' name='registrationUserInfo[mailAddress]' size='35' value="|-if isset($userinfo)-||-$userinfo->getMailAddress()-||-/if-||-if $failedRegistrationUserInfo neq ''-||-$failedRegistrationUserInfo.mailAddress-||-/if-|" />
		</p>
		<p>
		<label for="password">Contraseña *</label> 
			<input type='password' name='registrationUser[password]' size='15' />
		</p> 
		<p>
		<label for="check_password">Reingrese Contraseña *</label> 
			<input type='password' name='registrationUser[check_password]' size='15' />
		</p> 
		<p>
		<label for="surname">Apellido *</label> 
			<input type='text' name='registrationUserInfo[surname]' size='35' value="|-if isset($userinfo)-||-$userinfo->getSurname()-||-/if-||-if $failedRegistrationUserInfo neq ''-||-$failedRegistrationUserInfo.surname-||-/if-|" />
		</p> 
		<p>
		<label for="name">Nombre *</label> 

			<input type='text' name='registrationUserInfo[name]' size='35'value="|-if isset($userinfo)-||-$userinfo->getName()-||-/if-||-if $failedRegistrationUserInfo neq ''-||-$failedRegistrationUserInfo.name-||-/if-|" />
		</p> 
		<p>

		<label for="alternateMailAddress">Dirección de Email Alternativa</label> 
			<input type='text' name='registrationUserInfo[alternateMailAddress]' size='35' value="|-if isset($userinfo)-||-$userinfo->getAlternateMailAddress()-||-/if-||-if $failedRegistrationUserInfo neq ''-||-$failedRegistrationUserInfo.alternateMailAddress-||-/if-|" />
		</p>
		<p>
		<label for="occupation">Profesión</label> 

			<input type='text' name='registrationUserInfo[occupation]' size='35' value="|-if isset($userinfo)-||-$userinfo->getOccupation()-||-/if-||-if $failedRegistrationUserInfo neq ''-||-$failedRegistrationUserInfo.occupation-||-/if-|" />
		</p>
		<p>
		<label for="organization">Organización</label> 
			<input type='text' name='registrationUserInfo[organization]' size='45' value="|-if isset($userinfo)-||-$userinfo->getOrganization()-||-/if-||-if $failedRegistrationUserInfo neq ''-||-$failedRegistrationUserInfo.organization-||-/if-|" />
		</p>
		<p>
		<label for="telephone">Teléfono</label> 
			<input type='text' name='registrationUserInfo[telephone]' size='35' value="|-if isset($userinfo)-||-$userinfo->getTelephone()-||-/if-||-if $failedRegistrationUserInfo neq ''-||-$failedRegistrationUserInfo.telephone-||-/if-|" />
		</p>
		<p>
		<label for="alternateTelephone">Teléfono Alternativo</label> 

			<input type='text' name='registrationUserInfo[alternateTelephone]' size='35' value="|-if isset($userinfo)-||-$userinfo->getAlternateTelephone()-||-/if-||-if $failedRegistrationUserInfo neq ''-||-$failedRegistrationUserInfo.alternateTelephone-||-/if-|" />
		</p>
		<p>
			<label for="group">Grupo *</label> 
			<select	name="registrationUserInfo[group]">
				|-foreach from=$groups item=group key=key name=for_groups-|
				<option value="|-$key-|" |-if isset($userinfo) and $key eq $userinfo->getGroup()-|selected="selected"|-/if-| |-if $failedRegistrationUserInfo neq '' and $failedRegistrationUserInfo.group eq $key-|selected=selected|-/if-|>|-$group-|</value>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="country">Pais *</label> 
			<select	name="registrationUserInfo[country]">
				|-foreach from=$countries item=country name=for_groups-|
				|-if $country eq 'separator'-|
					<optgroup label="----------"></optgroup>
				|-else-|
				<option value="|-$country-|" |-if isset($userinfo) and $country eq $userinfo->getCountry()-|selected="selected"|-/if-||-if $failedRegistrationUserInfo neq '' and $failedRegistrationUserInfo.country eq $country-|selected=selected|-/if-|>|-$country-|</value>
				|-/if-|
				|-/foreach-|
			</select>
		</p>
		<p>
		<label for="state">Provincia *</label> 
			<input type='text' name='registrationUserInfo[state]' size='20' value="|-if isset($userinfo)-||-$userinfo->getState()-||-/if-||-if $failedRegistrationUserInfo neq ''-||-$failedRegistrationUserInfo.state-||-/if-|" />
		</p>
		|-if isset($admin) and $admin-|
		<p>
				<label for="state">Estado</label>
				<select name="registrationUser[active]">
					<option value="0" |-if isset($userByRegistration) and $userByRegistration->getActive() eq 0-|selected="selected"|-/if-|>Inactivo</option>
					<option value="1" |-if isset($userByRegistration) and $userByRegistration->getActive() eq 1-|selected="selected"|-/if-|>Activo</option>
				</select>
		</p>
		|-/if-|
		|-if isset($newsletterActive) and $newsletterActive-|
		<p>
		<label for="newsletterSubscribe">Subscripción a Newsletter</label> 
			<input type="hidden" name="registrationUserInfo[newsletterSubscribe]" value="0" />
			<input type='checkbox' name='registrationUserInfo[newsletterSubscribe]' value="1" |-if isset($userinfo) and $userinfo->getNewsletterSubscribe() eq 1-|checked="checked"|-/if-||-if $failedRegistrationUserInfo neq '' and $failedRegistrationUserInfo.newsletterSubscribe eq 1-|checked=checked|-/if-|/>
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

		|-if isset($loginUser) and isset($values.user_id)-|
		<p>
		<label for="created">Fecha de registro</label>  |-$userByRegistration->getCreated()-|
		</p>
		<p>
		<label for="ip">IP de registro</label>  |-$userByRegistration->getIp()-|
		</p>
		|-if $userByRegistration->getUpdated() != $userByRegistration->getCreated()-|
		<p>
		<label for="created">Fecha última modificación</label>  |-$userByRegistration->getUpdated()-|
		</p>
		|-/if-|
		<p>
		<label for="lastLogin">Fecha último ingreso</label>  |-$userByRegistration->getLastLogin()-|
		</p>
		|-/if-|

		<p>
			|-if isset($userByRegistration) or isset($values.user_id)-|
				<input type='hidden' name="action" value='update' class='button' />
				<input type='hidden' name="registrationUser[id]" value='|-if isset($userByRegistration)-||-$userByRegistration->getId()-||-else-||-$values.user_id-||-/if-|'/>
			|-else-|
				<input type='hidden' name="action" value='new' />
			|-/if-|
				<input type='submit' value='|-if isset($userByRegistration) or isset($values.user_id) or isset($session.login_user)-|Guardar|-else-|Solicitar registro|-/if-|'  />
		</p> 
	</fieldset> 
</form> 
|-if !(isset($loginUser))-|
</div>
|-/if-|
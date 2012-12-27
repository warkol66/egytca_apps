|-if isset($loggedUser) and get_class($loggedUser) eq "User"-|
<h2>Módulo de Registro de Usuarios</h2>
<h1>Administrar Registro de Usuarios</h1>
|-else-|
    |-if $registrationUser->isNew() -|
<div id="contentBody">
<div id="titleContent">Registro de Usuarios</div>
<h1>Alta de Usuario de Registro</h1>
    |-else-|
<div id="contentBody">
    <h1>Editar Mi Perfil</h1>
    |-/if-|
|-/if-|


|-if $message eq "error"-|
    |-if $error eq "error_fields"-|
        |-if isset($failures) and is_array($failures)-|
            |-foreach from=$failures item=error-|
        <div class="failureMessage errorMessage">|-$error->getMessage()-|.</div>
            |-/foreach-|
        |-/if-|
    |-elseif $error eq "error_passwd"-|
        <div class="failureMessage errorMessage">Las contraseñas proporcionadas no coinciden.</div>
    |-elseif $error eq "error_username_used"-|
        <div class="failureMessage errorMessage">El nombre de usuario se encuentra en uso, por favor ingrese uno distinto.</div>
    |-elseif $error eq "error_captcha"-|
        <div class="failureMessage errorMessage">Error en Código de Seguridad.</div>
    |-/if-|
|-elseif $message eq "saved"-|
    <div class='successMessage'>Sus datos se guardaron correectamente.</div>
|-/if-|
<form method="post" action="Main.php?do=registrationDoEdit"> 
	<fieldset> 
		<legend>
        |-if isset($loggedUser) and get_class($loggedUser) eq "User"-|
            |-if !$registrationUser->isNew()-|Editar|-else-|Crear|-/if-| Usuario Registrado
        |-else-|
            |-if !$registrationUser->isNew()-|Datos de Mi Perfil|-else-|Datos de Registro|-/if-|
        |-/if-|
        </legend>
		<p>Ingrese sus datos</p> 

		|-if !$registrationUser->isNew() &&  (!isset($loggedUser) || get_class($loggedUser) neq "User")-|
		<p>
			<label for="params[username]">Usuario</label>
			<input type="text" id="params[username]" size="35" readonly="readonly" value="|-$registrationUser->getUsername()-|" />
		</p>
        |-else-|
            <p>
                <label for="params[username]">Usuario</label>
                <input type="text" class="emptyValidation" id="params[username]" name="params[username]" size="35" value="|-$registrationUser->getUsername()-|" />
            </p>
		|-/if-|
		<p>
		<label for="params[mailAddress]">Dirección de Email</label>
			<input type="text" class="emptyValidation" id="params[mailAddress]" name="params[mailAddress]" size="35" value="|-if isset($registrationUser)-||-$registrationUser->getMailAddress()-||-/if-|" />
		</p>
		<p>
		<label for="params[password]">Contraseña</label>
			<input type="password" |-if $registrationUser->isNew()-|class="emptyValidation"|-/if-| id="params[password]" name="params[password]" size="15"  />
		</p> 
		<p>
		<label for="params[check_password]">Reingrese Contraseña</label>
			<input type="password" |-if $registrationUser->isNew()-|class="emptyValidation"|-/if-| id="params[check_password]" name="params[check_password]" size="15" />
		</p>
		<p>
		<label for="name">Nombre</label>
			<input type="text" class="emptyValidation" name="params[name]" size="35"value="|-$registrationUser->getName()-|" />
		</p>
        <p>
            <label for="params[surname]">Apellido</label>
            <input type="text" class="emptyValidation" id="params[surname]" name="params[surname]" size="35" value="|-$registrationUser->getSurname()-|" />
        </p>
		<p>
		<label for="params[alternateMailAddress]">Dirección de Email Alternativa</label>
			<input type="text" id="params[alternateMailAddress]" name="params[alternateMailAddress]" size="35" value="|-$registrationUser->getAlternateMailAddress()-|" />
		</p>
		<p>
		<label for="params[occupation]">Profesión</label>

			<input type="text" id="params[occupation]" name="params[occupation]" size="35" value="|-$registrationUser->getOccupation()-|" />
		</p>
		<p>
		<label for="params[organization]">Organización</label>
			<input type="text" id="params[organization]" name="params[organization]" size="45" value="|-$registrationUser->getOrganization()-|" />
		</p>
		<p>
		<label for="params[telephone]">Teléfono</label>
			<input type="text" id="params[telephone]" name="params[telephone]" size="35" value="|-$registrationUser->getTelephone()-|" />
		</p>
		<p>
		<label for="params[alternateTelephone]">Teléfono Alternativo</label>

			<input type="text" id="params[alternateTelephone]" name="params[alternateTelephone]" size="35" value="|-$registrationUser->getAlternateTelephone()-|" />
		</p>
		<p>
			<label for="params[country]">Pais</label>
			<select class="emptyValidation" id="params[country]"	name="params[country]">
				|-foreach from=$countries item=country name=for_groups-|
				|-if $country eq "separator"-|
					<optgroup label="----------"></optgroup>
				|-else-|
				<option value="|-$country-|" |-$country|selected:$registrationUser->getCountry()-|>|-$country-|</option>
				|-/if-|
				|-/foreach-|
			</select>
		</p>
		<p>
		<label for="params[state]">Provincia</label>
			<input type="text" id="params[state]" name="params[state]" size="20" value="|-$registrationUser->getState()-|" />
		</p>
		|-if isset($admin) and $admin-|
		<p>
				<label for="params[active]">Estado</label>
				<select name="params[active]" id="params[active]">
          <option value="1" |-$registrationUser->getActive()|selected:"1"-|>Activo</option>
					<option value="0" |-$registrationUser->getActive()|selected:"0"-|>Inactivo</option>
				</select>
		</p>
		|-/if-|
		|-*if isset($newsletterActive) and $newsletterActive*-|
		<p>
		<label for="params[newsletterSubscribe]">Subscripción a Newsletter</label>
			<input type="hidden" name="params[newsletterSubscribe]" value="0" />
			<input type="checkbox" id="params[newsletterSubscribe]" name="params[newsletterSubscribe]" value="1" |-$registrationUser->getNewsletterSubscribe()|checked_bool-|/>
		</p>
		|-*/if*-|

		|-if isset($useCaptcha) and $useCaptcha-|
		<p>
			<label for="security_code">Código de Seguridad</label>
            <img src="Main.php?do=commonImage" />
		</p>
		<p>
				Ingrese el código de seguridad de la imagen <br />
           <input class="emptyValidation" id="security_code" name="securityCode" type="text" size="10" />
		</p>

		|-/if-|

		|-if $smarty.session.loginRegistrationUser-|
		<p>
		<label for="created">Fecha de registro</label>
			<input type="text" id="created" size="20" readonly="readonly" value="|-$registrationUser->getCreatedAt()-|" />
		</p>
		<p>
		<label for="ip">IP de registro</label>
			<input type="text" id="ip" size="20" readonly="readonly" value="|-$registrationUser->getIp()-|" />
		</p>
		|-if $registrationUser->getUpdatedAt() != $registrationUser->getCreatedAt()-|
		<p>
			<label for="updated">Fecha última modificación</label>
			<input type="text" id="updated" size="20" readonly="readonly" value="|-$registrationUser->getUpdatedAt()-|" />
		</p>
		|-/if-|
		<p>
			<label for="lastLogin">Fecha último ingreso</label>
			<input type="text" id="lastLogin" size="20" readonly="readonly" value="|-$registrationUser->getLastLogin()-|" />
		</p>
		<p>
			<label for="passwordUpdated">Fecha última actualización de Contraseña</label>
			<input type="text" id="passwordUpdated" size="20" readonly="readonly" value="|-$registrationUser->getPasswordupdated()-|" />
		</p>
		|-/if-|
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		<p>
			|-if isset($loggedUser) and get_class($loggedUser) eq "User"-|
				<input type="hidden" name="id" value="|-$registrationUser->getId()-|"/>
                |-include file="FiltersRedirectInclude.tpl" filters=$filters-|
                |-if isset($smarty.request.page)-|
                <input type="hidden" name="page" value="|-$smarty.request.page-|"/>
                |-/if-|
			|-/if-|


            |-if isset($loggedUser)-|
                |-javascript_form_validation_button value=Guardar-|

                |-if get_class($loggedUser) eq "User"-|

                <input type='button' onClick='location.href="Main.php?do=registrationList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Usuarios Registrados"/>

                |-/if-|

            |-else-|
                |-javascript_form_validation_button value=Crear-|
            |-/if-|


		</p> 
	</fieldset> 
</form> 
|-if not isset($loggedUser) or get_class($loggedUser) neq "User"-|
</div>
|-/if-|
<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Instituciones</h1>
<!-- Link VOLVER --> 
<!-- /Link VOLVER --> 
|-if $message eq "wrongPassword"-|
<div class='errorMessage'>##185,Las contraseñas no coinciden##</div>
|-/if-|
|-if $message eq "emptyUsername"-|
<div class='errorMessage'>##185,Debe completar el nombre de usuario##</div>
|-/if-|
|-if $message eq "emptyAffiliateName"-|
<div class='errorMessage'>##185,El nombre de la Institución es obligatorio##</div>
|-/if-|
|-if $message eq "error"-|
<div class='errorMessage'>##185,Ha ocurrido un error##</div>
|-/if-|
<p>A continuación podrá editar la información de las Instituciones.</p>
<form method="post" action="Main.php?do=affiliatesDoAddAffiliate"> 

<fieldset title="Formulario de Alta de Instituciones" class="nestedFieldset">
<legend>Formulario de Alta de Instituciones</legend>
	<p>Ingrese los datos de la Institución que se desea agregar y los datos del respectivo usuario administrador.</p>

	<fieldset title="Formulario de Datos de Instituciones">
<legend>Datos de la Institución</legend>
	<p>Ingrese los datos de la Institución que se desea agregar.</p>
		|-include file="AffiliatesInfoInclude.tpl"-|	
</fieldset>


<fieldset title="Formulario de edición de Usuarios de Instituciones">
<legend>Datos del Usuario Administrador</legend>
	<p>Ingrese los datos del usuario administrador y haga click en "Agregar Institución "</p>
	<p><label for="affiliateUser[username]">##162,Identificación de Usuario##</label>
		<input name='affiliateUser[username]' type='text'  class='textodato' value='|-$user->getUsername()-|' size="40" />
	</p>
	<p><label for="affiliateUser[name]">##163,Nombre##</label>
			<input name='affiliateUserInfo[name]' type='text'  class='textodato' value='|-$userInfo->getName()-|' size="60" />
	</p>
	<p><label for="affiliateUser[surname]">##164,Apellido##</label>
			<input name='affiliateUserInfo[surname]' type='text'  class='textodato' value='|-$userInfo->getSurname()-|' size="60" />
	</p>
	<p><label for="affiliateUser[mailAddress]">E-mail</label>
			<input name='affiliateUserInfo[mailAddress]' type='text'  class='textodato' value='|-$userInfo->getMailAddress()-|' size="60" />
	</p>
	<p><label for="affiliateUser[password]">##165,Contraseña##</label>
			<input name='affiliateUser[password]' type='password' class='textodato' value='' size="20" />
	</p>
	<p><label for="affiliateUser[pass2]">##166,Repetir Contraseña##</label>
			<input name='affiliateUser[pass2]' type='password' class='textodato' value='' size="20" />
	</p>
	<p><label for="affiliateUser[levelId]">Nivel de Usuario</label>
        <select name='affiliateUser[levelId]'>
        	<option value="">Seleccionar nivel</option>
					|-foreach from=$levels item=level name=for_levels-|
        	<option value="|-$level->getId()-|"|-if $level->getId() eq $userInfo->getLevelId()-| selected="selected"|-/if-|>|-$level->getName()-|</option>
					|-/foreach-|
       	</select>

	</p>
	<p><label for="affiliateUser[timezone]">Huso Horario (GMT) del Usuario</label>
				<select name='affiliateUser[timezone]'>
					<option value="">seleccione una zona horaria (opcional)</option>
					|-foreach from=$timezones item=timezone name=for_timezones-|
					<option value="|-$timezone->getCode()-|" |-if $user->getTimezone() eq $timezone->getCode()-|selected="selected"|-/if-|>|-$timezone->getDescription()-|</option>
					|-/foreach-|
				</select>
		</p>
</fieldset> 
		<p> <input name="save" type="submit" value="Agregar Institución"> </p> 
</fieldset> 
</form>

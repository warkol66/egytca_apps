<h2>##40,Configuración del Sistema##</h2>
	<h1>Administración de Niveles de Usuarios</h1>
	<p>A continuación podrá editar un nivel usuario.</p>
	|-if $currentLevel->getId() ne ''-|
	  <p>Realice los cambios en el nivel de usuario y haga click en "Guardar" para guardar las modificaciones.</p>
	|-else-|
	  <p>Ingrese los datos del nuevo nivel de usuario y haga click en "Guardar".</p>
	|-/if-|
	
|-if $message eq "errorUpdate"-|
<div align="center" class="errorMessage">##182,Ha ocurrido un error al intentar guardar la información del nivel de usuarios##</div>
|-/if-|
|-if $currentLevel->getValidationFailures()|@count > 0-|
	<div class="errorMessage">
		<ul>
			|-foreach from=$currentLevel->getValidationFailures() item=error-|
				<li>|-$error->getMessage()-|</li>
			|-/foreach-|
		</ul>
	</div>
|-/if-|

<form method="post" action="Main.php">
	<fieldset title="Formulario de edición de nombre del Afiliado">
    <legend>Afiliado</legend>
    	<p>
    		<label for="params[name]">##196,Nombre del Nivel##</label>
			<input name="params[name]" type="text" value="|-$currentLevel->getName()-|" size="60">
		</p>
		<p>
			<input type="hidden" name="id" value="|-$currentLevel->getId()-|" />
			<input type="hidden" name="do" value="affiliatesUsersLevelsDoEdit" />
			<input name="save" type="submit" class="botonchico" value="##97,Guardar##"> 
			<input type="button" onClick="javascript:history.go(-1)" value="##104,Regresar##" class="botonchico"  />
		</p>
	</fieldset>
</form>

<h2>Configuración</h2>
<h1>Instalación  - Seleccionar idioma</h1>
<p>Seleccione el idioma o idiomas en los que realizará la instalación. Haga click en aceptar para continuar. </p>
<form method="GET" action="Main.php">
<fieldset title="Formulario para selección de idiomas de instalación">
	<legend>Idiomas disponibles</legend>
	|-foreach from=$languages item=language-|
	<p>
		<label>|-$language->getName()-|</label>
		<input type="checkbox" name="languages[]" value="|-$language->getCode()-|" />
	</p>
	|-/foreach-|
	<p>
		<input type="hidden" name="do" value="|-$nextDo-|" />
		<input type="hidden" name="moduleName" value="|-$moduleName-|" />
		|-if isset($mode)-|
		<input type="hidden" name="mode" value="|-$mode-|" id="mode">
		|-/if-|			
		<input type="submit" value="Aceptar" />
	</p>
</fieldset>
</form>

<script type="text/javascript" src="Main.php?do=js&name=js&module=modules&code=|-$currentLanguageCode-|"></script>
<h2>Configuración del Sistema</h2>
<h1>Instalación de Módulos: Módulo <strong>|-$moduleName|capitalize-|</strong>.</h1>
<form method="post">
<input type="hidden" name="moduleName" value="|-$moduleName-|" />
<fieldset>
	<legend>Configuración de mensajes de log</legend>
	<p>Asigne los mensajes del log correspondientes</p> 
		<p>
		<input type="submit" value="Guardar Mensajes" />
		|-include file="ModulesInstallFormNavigationInclude.tpl"-|
	</p>

</fieldset>
|-if $actions|@count gt 0-|
|-foreach from=$actions item=action-|
	<fieldset> 
		<legend>|-$action-|</legend>
		|-assign var="actionMessages" value=$messages[$action]-|
		|-foreach from=$actionMessages item=message-|
			<h4>|-$message|capitalize-|</h4>
			|-foreach from=$languages item=language-|
				|-assign var=languageCode value=$language->getCode()-|
				<p>
					<label for="message[|-$action-|][|-$message-|][|-$languageCode-|]">|-$language->getName()-|</label>
					<input name="message[|-$action-|][|-$message-|][|-$languageCode-|]" type="text" value="|-if isset($actualMessages)-||-$actualMessages.$action.$message.$languageCode-||-/if-|" size="65">
				</p>
			|-/foreach-|
		|-/foreach-|
	</fieldset>
	|-/foreach-|
	|-else-|
	<h4>No hay acciones que generen mensajes en el log</h4>
	|-/if-|
	<input type="hidden" name="moduleName" value="|-$moduleName-|" />
	<input type="hidden" name="do" value="modulesInstallDoSetupMessages" />
	|-if isset($mode)-|
		<input type="hidden" name="mode" value="|-$mode-|" id="mode">
	|-/if-|
	|-foreach from=$languages item=language-|
	<input type="hidden" name="languages[]" value="|-$language->getCode()-|" />
	|-/foreach-|
	<p>
		<input type="submit" value="Guardar Mensajes" />
		|-include file="ModulesInstallFormNavigationInclude.tpl"-|
	</p>
</form>

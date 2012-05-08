<script type="text/javascript" src="Main.php?do=js&name=js&module=modules&code=|-$currentLanguageCode-|"></script>

<h2>Configuración del Sistema</h2>
<h1>Instalación de Módulos: Módulo <strong>|-$moduleName|capitalize-|</strong>.</h1>
<form method="post">
<fieldset>
	<legend>Etiquetas de acciones</legend>
	<p>Asigne las etiquetas correspondientes</p> 
	<p>
		<input type="submit" value="Guardar archivo de etiquetas" />
		|-include file="ModulesInstallFormNavigationInclude.tpl"-|
	</p>
</fieldset>

|-foreach from=$actions item=action-|
	<fieldset> 
		<legend>|-$action-|</legend>
			<h4>|-$label|capitalize-|</h4>
			|-foreach from=$languages item=language-|
				|-assign var=languageCode value=$language->getCode()-|
				<p>
					<label for="labels[|-$action-|][|-$languageCode-|]">|-$language->getName()-|</label>
					<input name="labels[|-$action-|][|-$languageCode-|]" type="text" value="|-if isset($actualLabels)-||-$actualLabels.$action.$languageCode-||-/if-|" size="65">
				</p>
			|-/foreach-|

	</fieldset>
	|-/foreach-|
	
	<input type="hidden" name="moduleName" value="|-$moduleName-|" />
	<input type="hidden" name="do" value="modulesInstallDoSetupActionsLabel" />
	|-if isset($mode)-|
		<input type="hidden" name="mode" value="|-$mode-|" id="mode">
	|-/if-|
	|-foreach from=$languages item=language-|
	<input type="hidden" name="languages[]" value="|-$language->getCode()-|" />
	|-/foreach-|
	<p>
		<input type="submit" value="Guardar Labels" />
		|-include file="ModulesInstallFormNavigationInclude.tpl"-|
	</p>
</form>

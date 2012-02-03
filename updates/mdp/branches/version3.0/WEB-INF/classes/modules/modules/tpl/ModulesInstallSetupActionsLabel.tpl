<script type="text/javascript" src="Main.php?do=js&name=js&module=modules&code=|-$currentLanguageCode-|"></script>
|-include file="ModulesRemoveAction.tpl"-|
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
<div id="resultDiv"></div>
|-foreach from=$actions item=action-|
	<fieldset id="fieldset_|-$action-|"> 
		<legend>|-$action-|&nbsp; &nbsp; &nbsp; &nbsp; <input type="button" value="Remover" class="icon iconDelete" onclick="removeAction('|-$moduleName-|', '|-$action-|', removeFieldset('|-$action-|')); return false;" /></legend>
			<p>|-$label|capitalize-|</p>
			|-foreach from=$languages item=language-|
				|-assign var=languageCode value=$language->getCode()-|
				<h3>|-$language->getName()-|</h3>
				<p>
					<label for="labels[|-$action-|][|-$languageCode-|][label]">Etiqueta</label>
					<input name="labels[|-$action-|][|-$languageCode-|][label]" type="text" value="|-if isset($actualLabels)-||-$actualLabels.$action.$languageCode.label-||-/if-|" size="60">
				</p>
				<p>
					<label for="labels[|-$action-|][|-$languageCode-|][description]">Descripción</label>
					<input name="labels[|-$action-|][|-$languageCode-|][description]" type="text" value="|-if isset($actualLabels)-||-$actualLabels.$action.$languageCode.description-||-/if-|" size="60">
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


<script type="text/javascript" src="Main.php?do=js&name=js&module=modules&code=|-$currentLanguageCode-|"></script>
<h2>Configuración del Sistema</h2>
<h1>Instalación de Módulos: Módulo <strong>|-$moduleName|capitalize-|</strong>.</h1>
<form  method="post">
	<fieldset>
		<legend>Información del Módulo</legend>
		<p>Ingrese la información correspondiente al módulo</p>
			<p>
				<label>Nombre del Módulo:</label>
				<input name="name_disabled" type="text" disabled="disabled" value="|-$moduleName|capitalize-|" size="20" />
				<input name="name" type="hidden" value="|-$moduleName-|" />
			</p>
			<h4>Etiquetas</h4>	
			<p>Ingrese el nombre que aparecerá cuando se consulte el módulo <strong>|-$moduleName|capitalize-|</strong></p>
			|-foreach from=$languages item=language-|
				|-assign var=languageCode value=$language->getCode()-|
				|-assign var=label value=$labels.$languageCode-|
			<p>
				<label>|-$language->getName()-|:</label>
				<input name="labels[|-$language->getCode()-|]" type="text" value="|-if $label-||-$label->getLabel()-||-/if-|" size="35"/>
			</p>
			|-/foreach-|
			<h4>Descripción</h4>
			<p>Ingrese un texto que describa al módulo <strong>|-$moduleName|capitalize-|</strong></p>
			|-foreach from=$languages item=language-|
				|-assign var=languageCode value=$language->getCode()-|
				|-assign var=label value=$labels.$languageCode-|			
			<p>	
				<label>|-$language->getName()-|:</label>
				<input name="descriptions[|-$language->getCode()-|]" type="text" value="|-if $label-||-$label->getDescription()-||-/if-|" size="65"/>
			</p>
			|-/foreach-|
			<h4>
				Always Active</h4>
			<p>
				El módulo <strong>|-$moduleName|capitalize-|</strong> está siempre activo:</p>
			<p>
				<label>No</label>
				<input type="radio" name="alwaysActive" value="0" |-if isset($moduleObj) and ($moduleObj->getAlwaysActive() eq 0)-|checked="checked"|-else-|checked="checked"|-/if-|/>
			</p>
			<p>
				<label>Si</label>
				<input type="radio" name="alwaysActive" value="1" |-if isset($moduleObj) and ($moduleObj->getAlwaysActive() eq 1)-|checked="checked"|-/if-|/>			
			</p>
			<h4>Categorías</h4>
			<p>El módulo <strong>|-$moduleName|capitalize-|</strong> maneja categorías propias:</p>
			<p>
				<label>No</label>
				<input type="radio" name="hasCategories" value="0" |-if isset($moduleObj) and ($moduleObj->getHasCategories() eq 0)-|checked="checked"|-else-|checked="checked"|-/if-|/>
			</p>
			<p>
				<label>Si</label>
				<input type="radio" name="hasCategories" value="1" |-if isset($moduleObj) and ($moduleObj->getHasCategories() eq 1)-|checked="checked"|-/if-|/>			
			</p>			
			<h4>Dependencias</h4>
			<p>
				Indique aquellos módulos de los cuales depende el módulo <strong>|-$moduleName|capitalize-|</strong>.			</p>
			|-foreach from=$assignedDependencyModules item="dependency"-|
			<p>
				<label>|-$dependency->getName()-|</label> 
				<input type="checkbox" name="dependencies[]" value="|-$dependency->getName()-|" checked="checked"/>
			</p>
			|-/foreach-|
			|-foreach from=$dependencyModules item="dependency"-|
			<p>
				<label>|-$dependency->getName()-|</label> 
				<input type="checkbox" name="dependencies[]" value="|-$dependency->getName()-|"/>
			</p>
			|-/foreach-|
				
		<input type="hidden" name="moduleName" value="|-$moduleName-|" />
		<input type="hidden" name="do" value="modulesInstallDoSetupModuleInformation" />
		|-foreach from=$languages item=language-|
		<input type="hidden" name="languages[]" value="|-$language->getCode()-|" />
		|-/foreach-|
		|-if isset($mode)-|
		<input type="hidden" name="mode" value="|-$mode-|" id="mode">
		|-/if-|	
		<input type="submit" value="Generar archivo de información" />
		|-include file="ModulesInstallFormNavigationInclude.tpl"-|
	</fieldset>	
</form>

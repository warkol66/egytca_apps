<script type="text/javascript" src="Main.php?do=js&name=js&module=modules&code=|-$currentLanguageCode-|"></script>
<h2>Configuración del Sistema</h2>
<h1>Instalación de Módulos del Sistema: Módulo <strong>|-$moduleName-|</strong>.</h1>
<fieldset>
	<legend>Verificación de archivos</legend>
	<p>A continuación podrá verificar el resultado del proceso de instalación. La falta de alguno de los archivos no representa un error.</p>
	<div>
	<h4>Phpmvc-config.xml</h4>
	<p>El archivo phpmvc-config-|-$moduleName-|.xml |-if empty($phpConfigXMLContent)-|no se encontró en el directorio.|-else-|está presente.|-/if-|</p>
	</div>
	</fieldset>
	<fieldset>
	<legend>Archivos de instalación</legend>
	<h4>Información del Módulo</h4>
		<pre>|-$information-|</pre>
		|-foreach from=$informations item=information key=languageCode-|		
		<h5>|-$languageCode-|</h5>		
		<pre>|-$information-|</pre>
		|-/foreach-|
	<h4>Etiquetas de acciones</h4>
		|-foreach from=$actionsLabel item=labels key=languageCode-|		
		<h5>|-$languageCode-|</h5>		
		<pre>|-$labels-|</pre>
		|-/foreach-|
	<h4>Permisos</h4>
		<pre>|-$permissions-|</pre>
	<h4>Mensajes de log</h4>
		|-foreach from=$messages item=messages key=languageCode-|		
		<h5>|-$languageCode-|</h5>		
		<pre>|-$messages-|</pre>
		|-/foreach-|
	<h4>Traducciones</h4>
		|-foreach from=$multilangTexts item=multilangText key=languageCode-|		
		<h5>|-$languageCode-|</h5>		
		<pre>|-$multilangText-|</pre>
		|-/foreach-|

<p>
<br />
<form method="post">
	<input type="hidden" name="moduleName" value="|-$moduleName-|" />
	<input type="hidden" name="do" value="modulesInstallDoFileCheck" />
	|-foreach from=$languages item=language-|
	<input type="hidden" name="languages[]" value="|-$language->getCode()-|" />
	|-/foreach-|
	<input type="submit" value="Ir al listado de instalación" />
	<input type="button" value="Ejecutar SQLs" onClick="javascript:installExecuteSQL(this.form)"/>
</form>
</p>
</fieldset>

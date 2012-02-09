|-if $noModules neq ''-|
	Ningún módulo se marcó para instalar.
|-else-|
	
	<h2>Configuración</h2>
	<h1>Instalación  - Seleccionar idioma</h1>
	<p>Seleccione el idioma o idiomas en los que realizará la instalación. Haga click en aceptar para continuar. </p>
	<form method="POST" onsubmit="installModules(); return false;">
	<fieldset title="Formulario para selección de idiomas de instalación">
		<legend>Idiomas disponibles</legend>
		|-foreach from=$languages item=language-|
		<p>
			<label>|-$language->getName()-|</label>
			<input type="checkbox" name="languages[]" value="|-$language->getCode()-|" />
		</p>
		|-/foreach-|
		<p>
			<input type="hidden" name="modules" value="|-$modules-|" />	
			<input type="submit" value="Aceptar" />
		</p>
	</fieldset>
	</form>
	
|-/if-|

<script type="text/javascript" src="WEB-INF/classes/modules/modules/tpl/ModulesInstallJs.js"></script>
<script type="text/javascript">
	
	var success = true;
	
	function installModules() {
		|-foreach from=$modules item=module-|
				
			var form = document.createElement('form');
			
			var inputModuleName = createHidden('moduleName', '|-$module-|');
			form.appendChild(inputModuleName);
			
			var inputExecuteSQL = createHidden('executeSQL',1);
			form.appendChild(inputExecuteSQL);
			
			var languages = document.getElementsByName('languages[]');
			for (var i = 0; i < languages.length; i++) {
				if (languages[i].checked) {
					var inputLanguage = createHidden('languages[]', languages[i].value);
					form.appendChild(inputLanguage);
				}
			}
			
			new Ajax.Request(
				'Main.php?do=modulesInstallDoFileCheck',
				{
					method: 'post',
					postBody: Form.serialize(form),
					onFailure: function() {
						success = false;
					}
				}
			);
			
		|-/foreach-|
		
		if (success) {
			window.location = 'Main.php?do=modulesInstallList&message=success';
		}
		
	}
</script>

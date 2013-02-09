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

<script type="text/javascript">
	
	var success = true;
	
	function installModules() {
		|-foreach from=$modules item=module-|
				
			var form = $("<form></form>");
			var inputModuleName = $('<input></input>').attr('name','moduleName').attr('value','|-$module-|');
			
			form.append(inputModuleName);
		
			var inputExecuteSQL = $('<input></input>').attr('name','executeSQL').attr('value',1);
			
			form.append(inputExecuteSQL);
			
			var languages = $("[name='languages[]']");
			languages.each(function(){
				if($(this).checked){
					var inputLanguage = $('<input></input>').attr('name','languages[]').attr('value',$(this).val());
					form.append(inputLanguage);
				}
			});
			
			$('body').append(form)
			form.hide();
			
			$.ajax({
				url: 'Main.php?do=modulesInstallDoFileCheck',
				data: $(form).serialize(),
				type: 'post',
				error: function(data){
					success = false;
				}	
			});
			
		|-/foreach-|
		
		if (success) {
			window.location = 'Main.php?do=modulesInstallList&message=success';
		}
		
	}
</script>

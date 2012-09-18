<h2>##multilang,1,Multi-idioma##</h2>
<h1>##multilang,20,Administrar Traducciones##</h1>
<fieldset title="##multilang,22,Formulario para selección de módulo##">
<legend>##multilang,23,Selección de Módulo##</legend>
<form method="get" action="Main.php"> 
	<input type="hidden" name="do" value="servicesMultilangTextsDoDump" /> 
			<p><label for="moduleName">##multilang,24,Módulos disponibles##</label> 
				
					<!--<select name="moduleName" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" > -->
					<select name="moduleName"> 
						<option value="">##multilang,25,Seleccione un módulo##</option>
						 
		    		|-foreach from=$modules item=each_module name=for_module-|
						<option value="|-$each_module-|" |-$each_module|selected:$moduleName-|>|-$each_module|multilang_get_translation:"common"-| (|-$each_module-|)</option>
    				|-/foreach-|					
						<option value="system">System</option>
					</select>
	</p>
					    |-foreach from=$appLanguages item=language name=for_languages-|
							<p><label for="|-$language->getCode()-|">|-$language->getName()|multilang_get_translation:"common"-|</label>
							<input type="radio" name="languageCode" value="|-$language->getCode()-|" id="|-$language->getCode()-|" |-if $languageCode eq $language->getCode()-|checked="checked"|-/if-| />
					   </p> |-/foreach-|
							<p>
								<label for="sys">system</label>
							<input type="radio" name="languageCode" value="sys" id="sys" |-if $languageCode eq "sys"-|checked="checked"|-/if-| />
					   </p>
						 	<p>
		<input name="Submit" type="submit" class="button" value="Generar dump con textos" />
	</p>
</form>
</fieldset> 

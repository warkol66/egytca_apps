<form action="Main.php" method="get">
<fieldset title="##multilang,32,Formulario de búsqueda de traducciones##">
	<legend>##multilang,33,Búsqueda de textos##</legend>  
	<p><label for="language_id">##multilang,34,Seleccione un idioma##</label>
    <select name="languageCode">
		|-foreach from=$appLanguages item=language name=for_languages-|
      <option value="|-$language->getCode()-|">|-$language->getName()-|</option>
		|-/foreach-|
    </select></p>
  	<p><label for="search">##multilang,35,Buscar texto##</label>
  	<input type="text" id="search" name="search" value="|-$search-|" />
  	<input type="hidden" name="moduleName" value="|-$moduleName-|" />
  	<input type="hidden" name="do" value="multilangTextsList" />
		</p>
  	<input type="submit" value="##common,4,Buscar##" />
</fieldset>
</form>

<h2>##multilang,1,Multi-idioma##</h2>
|-if $action eq 'edit'-|
<h1>##multilang,1000,Editar Múltiples Traducciones##</h1>
<p>##multilang,1000,A continuación se muestra el formulario de edición de traducciones bulk. Modifique las traducciones y haga click en "Aceptar" para guardar los cambios.##
|-else-|
<h1>##multilang,51,Crear Múltples Traducciones##</h1>
<p>##multilang,52,A continuación se muestra el formulario de creación de traducciones múltiples. Para agregar una nueva fila de traducciones, haga click en "Agregar traducción" y una nueva fila aparecerá. Ingrese las traducciones y haga click en "Aceptar" para crear los textos.##
|-/if-|
<div id="div_text">
  <form name="form_edit_text" id="form_edit_text" action="Main.php" method="post">
    |-if $message eq "error"-|
			<div class="failureMessage">##multilang,40,Ha ocurrido un error al intentar guardar las traducciones##</div>
		|-/if-|
    <fieldset title="##multilang,41,Formulario de edición de datos de traducción##">
    
    <p>
    	<label>##multilang,44,Corresponde a módulo##:</label><br/>
    	<select name="moduleId">
				<option value="">##multilang,45,Sin Modulo Asignado##</option>
		    |-foreach from=$modules item=moduleObj name=for_module-|
	    		<option value="|-$moduleObj->getName()-|" |-if (isset($text) and $text->getModuleName() eq $moduleObj->getName()) or ($moduleObj->getName() eq $moduleName)-|selected="selected"|-/if-|>|-$moduleObj->getName()|multilang_get_translation:"common"-|</option>
    		|-/foreach-|
    	</select>
    </p>    
    
    <p>##multilang,42,Ingrese las traducciones.##</p>
    
    <div id="textsBulkEdit">
    |-math equation="x / y" x=100 y=$appLanguagesCount format="%.0f" assign=textareaCols-|
    |-math equation="x / y" x=90 y=$appLanguagesCount  format="%.0f" assign=labelsWidth-|
	    <div style="display:none;">
		    |-foreach from=$appLanguages item=language name=for_languages-|
		    |-assign var="languageCode" value=$language->getCode()-|
		    |-assign var="languageName" value=$language->getName()-|
		    <p style="float:left;width:|-$labelsWidth-|%;clear:none;">
		      <label for="text[][|-$languageCode-|]">|-$languageName-|</label>
		      <textarea name="text[][|-$languageCode-|]" cols="|-$textareaCols-|" rows="3" wrap="virtual" /></textarea>
		    </p>
		    |-/foreach-|    
	    </div>
	    
	   	<div>
		    |-foreach from=$appLanguages item=language name=for_languages-|
		    |-assign var="languageCode" value=$language->getCode()-|
		    |-assign var="languageName" value=$language->getName()-|
		    |-if $action eq "edit"-||-assign var="text" value=$texts[$languageCode]-||-/if-|
		    <p style="float:left;width:|-$labelsWidth-|%;clear:none;">
		      <label for="text[][|-$languageCode-|]">|-$languageName-|</label>
		      <textarea name="text[][|-$languageCode-|]" cols="|-$textareaCols-|" rows="3" wrap="virtual" />|-if $text ne ""-||-$text->gettext()-||-/if-|</textarea>
		      |-if $action eq "edit" and $text ne ""-|
		      <br />
					##multilang,43,Código de inserción##: #&#0035;|-$moduleName-|,|-$textId-|,|-$text->gettext()-|#&#0035;
		      |-/if-| 
		    </p>	    
		    |-/foreach-|
	    </div>

		<a href="#" onclick="return addTranslation(this)" class="addLink" title="##multilang,29,Agregar Traducción##">##multilang,29,Agregar Traducción##</a>

	</div>
    
    <p> |-if $action eq "edit"-|
      <input type="hidden" name="id" id="id" value="|-if $action eq "edit"-||-$textId-||-/if-|" />
      |-/if-|
      <input type="hidden" name="action" id="action" value="|-$action-|" />
      <input type="hidden" name="do" id="do" value="multilangTextsDoEditBulk" />
      <input type="hidden" name="moduleName" value="|-$moduleName-|" />
      <input type="hidden" name="currentPage" value="|-$currentPage-|" />
      <input type="submit" id="button_edit_text" name="button_edit_text" title="##common,3,Aceptar##" value="##common,3,Aceptar##" class="button" />
    </p>
    </fieldset>
  </form>
</div>

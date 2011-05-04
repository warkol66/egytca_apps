<h2>##multilang,1,Multi-idioma##</h2>
<h1>##multilang,20,Administrar Traducciones##</h1>
<p>##multilang,21,Con esta aplicación puede administrar los textos que mostrará el sistema según el idioma del usuario. Seleccione un módulo y agregue un nuevo texto o edite los valores actuales.##</p>
<fieldset title="##multilang,22,Formulario para selección de módulo##">
<legend>##multilang,23,Selección de Módulo##</legend>
<form method="get" action="Main.php"> 
	<input type="hidden" name="do" value="multilangTextsList" /> 
			<label for="moduleName">##multilang,24,Módulos disponibles##</label> 
				<select name="moduleName" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" > 
					<option value="">##multilang,25,Seleccione un módulo##</option> 
		    		|-foreach from=$modules item=moduleObj name=for_module-|
	    			<option value="|-$moduleObj->getName()-|" |-if $moduleName eq $moduleObj->getName()-|selected="selected"|-/if-|>|-$moduleObj->getName()|multilang_get_translation:"common"-|</option>
    				|-/foreach-|					
				</select>
</form>
</fieldset> 

|-if $moduleName-|
<h3>##multilang,26,Textos del módulo## &quot;|-$moduleName|multilang_get_translation:"common"-|&quot;</h3>
<div id="div_texts">
|-if $message eq "ok"-|
	<div class='successMessage'>##multilang,27,Texto guardado correctamente##</div>
|-elseif $message eq "deleted_ok"-|
	<div class='successMessage'>##multilang,28,Texto eliminado correctamente##</div>
|-/if-|
  |-include file="MultilangTextsIncludeSearch.tpl"-|
	<table width="100%" border="0" cellpadding="5" cellspacing="0" id="tabla-texts" class="tableTdBorders">
    <thead>
			<tr>
				 <th colspan="|-math equation = 'lang + 2' lang=$appLanguages|@count-|"><div class="rightLink"><a href="Main.php?do=multilangTextsEdit&amp;moduleName=|-$moduleName-|" class="addLink" title="##multilang,29,Agregar Traducción##">##multilang,29,Agregar Traducción##</a>&nbsp;<a href="Main.php?do=multilangTextsEditBulk&amp;moduleName=|-$moduleName-|" class="addLink" title="##multilang,53,Agregar Múltiples Traducciones##">##multilang,53,Agregar Múltiples Traducciones##</a></div></th>
			</tr>
      <tr>
        <th width="5%">##multilang,7,Id##</th>
				|-math equation = "90 / lang" lang=$appLanguages|@count assign="colwidth" format="%.0f"-|		
        |-foreach from=$appLanguages item=language name=for_languages-|
        <th width="|-$colwidth-|%">|-$language->getName()-|</th>
        |-/foreach-|
        <th width="5%">&nbsp;</th>
      </tr>
    </thead>
    <tbody>   
    |-if $texts|@count lt 1-|
		<tr>
			<td colspan="|-math equation = 'lang + 2' lang=$appLanguages|@count-|">##multilang,30,No hay textos disponibles para el módulo seleccionado##
			</td>
		</tr>|-else-|
    |-foreach from=$texts item=textLanguages key=textId name=for_texts-|
    <tr>
      <td>|-$textId-|</td>
      |-foreach from=$appLanguages item=language name=for_languages-|
      |-assign var="languageCode" value=$language->getCode()-|
      |-assign var="text" value=$textLanguages[$languageCode]-|
      |-if $text ne ""-|
      	|-assign var="textContent" value=$text->getText()-|
      |-/if-|
      <td>|-if $text ne ""-||-$text->gettext()-|<div align="right" style="margin-top:8px;margin-right:8px;">
			<a href="#" |-popup sticky=true caption="Text Code" trigger="onClick" text="##multilang,43,Código de inserción##: #&#0035;$moduleName,$textId,$textContent#&#0035;" snapx=10 snapy=10-| class="detail"><img src="images/copycode14.png" border="0" /></a></div>
      |-/if-|</td>
      |-/foreach-|
      <td align="center" nowrap="nowrap">
					<a href="Main.php?do=multilangTextsEdit&id=|-$textId-|&moduleName=|-$moduleName-|&currentPage=|-$pager->getPage()-|" title="##common,1,Editar##"><img src="images/clear.png" class="iconEdit" /></a>
					<form action="Main.php" method="post" name='formTextsDoDelete|-$textId-|' style="display:inline">
          <input type="hidden" name="do" value="multilangTextsDoDelete" />
          <input type="hidden" name="id" value="|-$textId-|" />
          <input type="hidden" name="moduleName" value="|-$moduleName-|" />
          <input type="hidden" name="currentPage" value="|-$pager->getPage()-|" />
					<a href="javascript:document.formTextsDoDelete|-$textId-|.submit();" onclick="return confirm('##multilang,31,¿Está seguro que desea eliminar estas traducciones?##')" title="##common,2,Eliminar##"><img src="images/clear.png" class="iconDelete" /></a>
				</form>
			</td>
    </tr>
    |-/foreach-|
		|-/if-|
    </tbody>
		<tr>
			<td colspan="|-math equation = 'lang + 2' lang=$appLanguages|@count-|" class="pages">|-include file="PaginateInclude.tpl"-|</td>
		</tr>
		<tr>
			 <th colspan="|-math equation = 'lang + 2' lang=$appLanguages|@count-|"><div class="rightLink"><a href="Main.php?do=multilangTextsEdit&amp;moduleName=|-$moduleName-|" class="addLink" title="##multilang,29,Agregar Traducción##">##multilang,29,Agregar Traducción##</a>&nbsp;<a href="Main.php?do=multilangTextsEditBulk&amp;moduleName=|-$moduleName-|" class="addLink" title="##multilang,53,Agregar Múltiples Traducciones##">##multilang,53,Agregar Múltiples Traducciones##</a></div></th>
		</tr>
  </table>
</div>
|-/if-|

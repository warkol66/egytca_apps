<script type="text/javascript" src="scripts/overlib_cssw3c.js"></script>
<script type="text/javascript">
	overlib_pagedefaults(FGCOLOR, '#e7ecf2', BGCOLOR, '#0066cc', TEXTCOLOR, '#666666',CELLPAD,15,BORDER,5,SNAPX,10,SNAPY,10, VAUTO);
</script>

<h2>##multilang,1,Multi-idioma##</h2>
<h1>##multilang,20,Administrar Traducciones##</h1>
|-if !$search-|<p>##multilang,21,Con esta aplicación puede administrar los textos que mostrará el sistema según el idioma del usuario. Seleccione un módulo y agregue un nuevo texto o edite los valores actuales.##</p>
|-else-|<p>##multilang,46,Resultados de la búsqueda de textos en el módulo:## &quot;|-$moduleName-|&quot;</p>|-/if-|
|-if $message eq "ok"-|
<div class='successMessage'>##multilang,27,Texto guardado correctamente##</div>
|-elseif $message eq "deleted_ok"-|
<div class='successMessage'>##multilang,28,Texto eliminado correctamente##</div>
|-/if-|
<div id="div_texts">
<fieldset title="##multilang,22,Formulario para selección de módulo##">
<legend>##multilang,23,Selección de Módulo##</legend>
<form method="get" action="Main.php"> 
	<p><label for="moduleName">##multilang,24,Módulos disponibles##</label> 
		<select name="moduleName" onChange="if (this.options[this.selectedIndex].value) this.form.submit()" > 
			<option value="">##multilang,25,Seleccione un módulo##</option> 
		|-foreach from=$modules item=eachModule name=for_module-|
			<option value="|-$eachModule-|" |-$eachModule|selected:$moduleName-|>|-$eachModule|multilang_get_translation:"common"-|</option>
		|-/foreach-|					
		</select></p>
  	<input type="hidden" name="do" value="servicesMultilangTextsList" />
</form>
|-if $moduleName-|
<a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">##multilang,32,Formulario de búsqueda de traducciones##</a><div id="divSearch" style="display:|-if $search-|block|-else-|none|-/if-|;">
<form method="get" action="Main.php"> 
<p>##multilang,33,Búsqueda de textos##</p>
	<p><label for="languageCode">##multilang,34,Seleccione un idioma##</label>
    <select name="languageCode">
		|-foreach from=$appLanguages item=language name=for_languages-|
      <option value="|-$language->getCode()-|">|-$language->getName()-|</option>
		|-/foreach-|
    </select></p>
		<p><label for="search">##multilang,35,Buscar texto##</label>
      <input name="search" type="text" id="search" value="|-$search-|" size="30" maxlength="35" />  	
	  	<input type="submit" value="##common,4,Buscar##" />
		</p>
  	<input type="hidden" name="moduleName" value="|-$moduleName-|" />
  	<input type="hidden" name="do" value="servicesMultilangTextsList" />
</form></div>
|-/if-|
</fieldset> 

|-if !$search-|
	<table width="100%" border="0" cellpadding="5" cellspacing="0" id="tabla-texts" class="tableTdBorders">
    <thead>
			<tr>
				 <th colspan="|-math equation = 'lang + 2' lang=$appLanguages|@count-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=servicesMultilangTextsEdit&amp;moduleName=|-$moduleName-|" class="addLink" title="##multilang,29,Agregar Traducción##">##multilang,29,Agregar Traducción##</a>&nbsp;<a href="Main.php?do=servicesMultilangTextsEditBulk&amp;moduleName=|-$moduleName-|" class="addLink" title="##multilang,53,Agregar Múltiples Traducciones##">##multilang,53,Agregar Múltiples Traducciones##</a></div></th>
			</tr>
      <tr class="thFillTitle">
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
      	|-assign var="textContent" value=$text->getText()|escape-|
      |-/if-|
      <td>|-if $text ne ""-||-$text->gettext()-|<div align="right" style="margin-top:8px;margin-right:8px;float:right">
			<a href="#" |-popup sticky=true caption="Text Code" closetext="Cerrar" trigger="onClick" text="##multilang,43,Código de inserción##:<br />#&#0035;$moduleName,$textId,$textContent#&#0035;"-|><img src="images/icon_copy.png" /></a></div>
      |-/if-|</td>
      |-/foreach-|
      <td align="center" nowrap="nowrap">
					<a href="Main.php?do=servicesMultilangTextsEdit&id=|-$textId-|&moduleName=|-$moduleName-|&currentPage=|-$pager->getPage()-|" title="##common,1,Editar##"><img src="images/clear.png" class="icon iconEdit" /></a>
					<form action="Main.php" method="post" name='formTextsDoDelete|-$textId-|' style="display:inline">
          <input type="hidden" name="do" value="servicesMultilangTextsDoDelete" />
          <input type="hidden" name="id" value="|-$textId-|" />
          <input type="hidden" name="moduleName" value="|-$moduleName-|" />
          <input type="hidden" name="currentPage" value="|-$pager->getPage()-|" />
					<a href="javascript:document.formTextsDoDelete|-$textId-|.submit();" onclick="return confirm('##multilang,31,¿Está seguro que desea eliminar estas traducciones?##')" title="##common,2,Eliminar##"><img src="images/clear.png" class="icon iconDelete" /></a>
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
			 <th colspan="|-math equation = 'lang + 2' lang=$appLanguages|@count-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=servicesMultilangTextsEdit&amp;moduleName=|-$moduleName-|" class="addLink" title="##multilang,29,Agregar Traducción##">##multilang,29,Agregar Traducción##</a>&nbsp;<a href="Main.php?do=servicesMultilangTextsEditBulk&amp;moduleName=|-$moduleName-|" class="addLink" title="##multilang,53,Agregar Múltiples Traducciones##">##multilang,53,Agregar Múltiples Traducciones##</a></div></th>
		</tr>
  </table>

|-else-|

	<p>##multilang,47,Idioma##: <span>|-$searchLanguage->getName()-|</span> - ##multilang,48,Texto buscado##: <span>|-$search-|</span> <a href="Main.php?do=servicesMultilangTextsList&moduleName=|-$moduleName-|">##multilang,49,Ver todos##</a></p>
	|-if $texts|@count eq 0-|
	<h4>##multilang,50,Su búsqueda no obtuvo resultados##</h4>
	|-else-|
 	<table width="100%" border="0" cellpadding="5" cellspacing="0" id="tabla-texts" class="tableTdBorders">
    <thead>
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=servicesMultilangTextsEdit&amp;moduleName=|-$moduleName-|" class="addLink" title="##multilang,29,Agregar Traducción##">##multilang,29,Agregar Traducción##</a></div></th>
			</tr>
   <thead>
      <tr>
        <th width="5%">##multilang,7,Id##</th>
        <th width="90%">|-$searchLanguage->getName()-|</th>
        <th width="5%">&nbsp;</th>
      </tr>
    </thead>
    <tbody>   
    |-foreach from=$texts item=text name=for_texts-|
    <tr>
      <td>|-$text->getId()-|</td>
      |-assign var="textContent" value=$text->getText()-|
      |-assign var="textId" value=$text->getId()-|
      <td>|-if $text ne ""-||-$text->gettext()-|<div align="right" style="margin-top:8px;margin-right:8px;float:right">
			<a href="#" |-popup sticky=true caption="Text Code" trigger="onClick" text="##multilang,43,Código de inserción##: #&#0035;$moduleName,$textId,$textContent#&#0035;" snapx=10 snapy=10-|><img src="images/icon_copy.png" /></a></div>
      |-/if-|</td>
      <td align="center" nowrap="nowrap">
				<a href="Main.php?do=servicesMultilangTextsEdit&id=|-$textId-|&moduleName=|-$moduleName-|&currentPage=|-$pager->getPage()-|" title="##common,1,Editar##"><img src="images/clear.png" class="icon iconEdit" /></a>
        <form action="Main.php" method="post" name='formTextsDoDelete|-$textId-|' style="display:inline">
          <input type="hidden" name="do" value="servicesMultilangTextsDoDelete" />
          <input type="hidden" name="id" value="|-$textId-|" />
          <input type="hidden" name="moduleName" value="|-$moduleName-|" />
          <input type="hidden" name="currentPage" value="|-$pager->getPage()-|" />
					<a href="javascript:document.formTextsDoDelete|-$textId-|.submit();" onclick="return confirm('##multilang,31,¿Está seguro que desea eliminar estas traducciones?##')" title="##common,2,Eliminar##"><img src="images/clear.png" class="icon iconDelete" /></a>
					</form></td>
    </tr>
    |-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
    </tbody>
  </table>
	|-/if-|
|-/if-|

</div>

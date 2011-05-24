<h2>##multilang,1,Multi-idioma##</h2>
<h1>##multilang,20,Administrar Traducciones##</h1>
|-popup_init src="scripts/overlib.js"-|
<p>##multilang,46,Resultados de la búsqueda de textos en el módulo:## &quot;|-$moduleName-|&quot;</p>
<div id="div_texts">
	|-if $message eq "ok"-|
	<div class='successMessage'>##multilang,27,Texto guardado correctamente##</div>
	|-elseif $message eq "deleted_ok"-|
	<div class='successMessage'>##multilang,28,Texto eliminado correctamente##</div>
	|-/if-|
	|-include file="MultilangTextsIncludeSearch.tpl"-|
	<p>##multilang,47,Idioma##: <span>|-$searchLanguage->getName()-|</span> - ##multilang,48,Texto buscado##: <span>|-$search-|</span> <a href="Main.php?do=multilangTextsList&moduleName=|-$moduleName-|">##multilang,49,Ver todos##</a></p>
	|-if $texts|@count eq 0-|
	<h4>##multilang,50,Su búsqueda no obtuvo resultados##</h4>
	|-else-|
 	<table width="100%" border="0" cellpadding="5" cellspacing="0" id="tabla-texts" class="tableTdBorders">
    <thead>
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=multilangTextsEdit&amp;moduleName=|-$moduleName-|" class="addLink" title="##multilang,29,Agregar Traducción##">##multilang,29,Agregar Traducción##</a></div></th>
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
      <td>|-if $text ne ""-||-$text->gettext()-|<div align="right" style="margin-top:8px;margin-right:8px;">
			<a href="#" |-popup sticky=true caption="Text Code" trigger="onClick" text="##multilang,43,Código de inserción##: #&#0035;$moduleName,$textId,$textContent#&#0035;" snapx=10 snapy=10-| class="detail"><img src="images/copycode14.png" border="0" /></a></div>
      |-/if-|</td>
      <td align="center" nowrap="nowrap">
				<a href="Main.php?do=multilangTextsEdit&id=|-$textId-|&moduleName=|-$moduleName-|&currentPage=|-$pager->getPage()-|" title="##common,1,Editar##"><img src="images/clear.png" class="icon iconEdit" /></a>
        <form action="Main.php" method="post" name='formTextsDoDelete|-$textId-|' style="display:inline">
          <input type="hidden" name="do" value="multilangTextsDoDelete" />
          <input type="hidden" name="id" value="|-$textId-|" />
          <input type="hidden" name="moduleName" value="|-$moduleName-|" />
          <input type="hidden" name="currentPage" value="|-$pager->getPage()-|" />
					<a href="javascript:document.formTextsDoDelete|-$textId-|.submit();" onclick="return confirm('##multilang,31,¿Está seguro que desea eliminar estas traducciones?##')" title="##common,2,Eliminar##"><img src="images/clear.png" class='iconDelete' /></a>
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
</div>



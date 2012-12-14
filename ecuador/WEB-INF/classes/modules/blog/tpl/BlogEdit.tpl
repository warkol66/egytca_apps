|-if !is_object($blogEntry)-|
<div>Entrada no encontrada, puede que haya sido eliminada o esté incorrectamente identificada.<br />
Puede regresar a la página principal del blog haciendo click <a href="Main.php?do=blogList">aquí</a></div>
|-else-|
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$.datepicker.setDefaults(jQuery.datepicker.regional['es']);
        $( ".datepicker" ).datepicker({
			dateFormat:"dd-mm-yy"
		});
        
        $("a#inline").fancybox();	

	});//fin docready
 
</script>
<div style="display:none;">
	<div id="data">
		<p align="right">			
			<a href="javascript:$.fancybox.close();" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconDelete" /></a> 
		</p> 
		|-include file="BlogTagsEditX.tpl"-|
		</p> 
	</div>
</div>
<script src="Main.php?do=js&name=js&module=blog&code=|-$currentLanguageCode-|" type="text/javascript"></script>
|-include file='BlogEditTinyMceInclude.tpl' elements="params_body" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-| 
<h2>##blog,1,Entradas##</h2>
<h1>|-if !$blogEntry->isNew()-|##blog,23,Editar entrada##|-else-|##blog,24,Crear entrada##|-/if-| </h1>
|-if $message eq "ok"-|
	<div class="successMessage">Entrada guardada correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">##blog,25,Ha ocurrido un error al intentar guardar la entrada##</div>
|-/if-|
<div id="div_blogEntry">
	<form name="form_edit_blogEntry" id="form_edit_blogEntry" action="Main.php" method="post">
		<p>##blog,26,Ingrese los datos de la entrada##</p>
		<fieldset title="##blog,27,Formulario de edición de datos de un noticia##">
		<legend>##blog,28,Formulario de Entrada##</legend>
			<p>
				<label for="params_title">##blog,10,Título##</label>
				<input name="params[title]" type="text" id="params_title" title="title" value="|-$blogEntry->gettitle()|escape-|" size="60" maxlength="255" />
			</p>
			<p>
				<label for="params_body">##blog,32,Texto de la entrada##</label>
				<textarea name="params[body]" cols="60" rows="15" wrap="VIRTUAL"  id="params_body">|-$blogEntry->getbody()|htmlentities-|</textarea>
		</p>
			<p>
				<label for="params_creationDate">##blog,35,Fecha de Creación##</label>
				<input name="params[creationDate]" type="date" id="params_creationDate" class="datepicker" title="creationDate" value="|-$blogEntry->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			|-assign var=entryId value=$blogEntry->getId()-|
			|-if not empty($entryId)-|
			<p>
				<label for="params_status">##blog,13,Estado##</label>
				<select name="params[status]" id="params_status">
					|-foreach from=$blogEntryStatus key=key item=name-|
						<option value="|-$key-|" |-if ($blogEntry->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
					|-/foreach-|
				</select>
			</p>
			|-/if-|
|-if $blogConfig.useCategories.value eq "YES"-|<p>
				<label for="params_categoryId">##blog,14,Categoría##</label>
				<select id="params_categoryId" name="params[categoryId]" title="categoryId">
					<option value="">##blog,18,Seleccione una categoría##</option>
									|-foreach from=$categoryIdValues item=object-|
									<option value="|-$object->getid()-|" |-if $blogEntry->getcategoryId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
									|-/foreach-|
								</select>
		</p>|-/if-|
			<p>
				<label for="params_userId">##blog,38,Usuario##</label>
				<select id="params_userId" name="params[userId]" title="userId">
					<option value="">##blog,39,Seleccione un Usuario##</option>
									|-foreach from=$userIdValues item=object-|
									<option value="|-$object->getid()-|" |-if $blogEntry->getuserId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getusername()-|</option>
									|-/foreach-|
								</select>
		</p>
				|-if $blogEntry neq ''-|
|-if $blogConfig.bodyOnArticlesShow.value eq "NO"-|<p>
				<label>Vistas</label> |-$blogEntry->getViews()-| veces
			</p>|-/if-|
				|-/if-|
				|-if !$blogEntry->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$blogEntry->getid()-|" />
				<input type="hidden" name="params[url]" id="params_url" value="|-$blogEntry->getUrl()-|" />
				|-/if-|
				
			<p>	
				<!--pasaje de parametros de filtros -->
				<input type="hidden" name="filters" value="|-$filtersUrl-|" />
					
				<input type="hidden" name="action" id="action" value=|-if !$blogEntry->isNew()-|"edit"|-else-|"create"|-/if-| />
				<input type="hidden" name="do" id="doEdit" value="blogDoEdit" />
				<input type="button" id="button_edit_blogEntry" name="button_edit_blogEntry" title="##blog,40,Guardar##" value="##blog,40,Guardar##" onClick="location.href='Main.php?do=blogDoEdit&id=|-$blogEntry->getId()-|&|-$filtersUrl-||-if isset($page) -|&page=|-$page-||-/if-|'"  />			
				<input type="button" id="button_return_project" name="button_return_project" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=blogList&|-$filtersUrl-||-if isset($page) -|&page=|-$page-||-/if-|'" />
				|-if !$blogEntry->isNew()-|
				<input type="button" id="button_edit_blogEntry" name="button_edit_blogEntry" title="##blog,42,Vista previa en listado##" value="##blog,42,Vista previa en listado##" onClick="javascript:submitPreviewOnHome(this.form)"/>
				|-/if-|
	|-if $blogConfig.bodyOnArticlesShow.value eq "NO"-|<input type="button" id="button_edit_blogEntry" name="button_edit_blogEntry" title="##blog,41,Vista previa del detalle##" value="##blog,41,Vista previa del detalle##" onClick="javascript:submitPreviewDetailed(this.form)"  />|-/if-|
			</p>
			<p>
			</p>
		</fieldset>
	</form>
</div>
|-if $blogConfig.useCommets.value eq "YES" && !$blogEntry->isNew()-|	<div>
		<fieldset>
			<form action="Main.php" method="get">
				<input type="hidden" name="entryId" value="|-$blogEntry->getId()-|" id="entryId" />
				<input type="hidden" name="do" value="blogCommentsList" />
				<input type="submit" value="Ver comentarios asociados a este artículo" />
			</form>
		</fieldset>
	</div>
|-/if-|
|-if !$blogEntry->isNew()-|
<fieldset title="Formulario de edición de etiquetas">
	<legend>Etiquetas</legend>
<div id="tagAdding"> <span id="tagMsgField"></span> 
  <form method="post"> 
    <p> 
      <select id="tagId" name="tagId" title="tagId" > 
      <option value="">Seleccione una etiqueta</option>
				|-foreach from=$tags item=tag name=for_tag-|
        <option id="tagOption|-$tag->getId()-|" value="|-$tag->getId()-|" >|-$tag->getName()-|</option> 
				|-/foreach-|
      </select> 
      <input type="hidden" name="do" id="do" value="blogDoAddTagToEntryX" /> 
      <input type="hidden" name="entryId" id="entryId" value="|-$blogEntry->getId()-|" /> 
      <input type="button" value="Asignar etiqueta" onClick="javascript:addTagToEntry(this.form)"/> 
			<a href="#data" id="inline" rel="inline" class="lbOn addNew">Agregar nueva etiqueta</a>
    </p> 
  </form> 
  <ul id="tagList" class="optionDelete">|-assign var=actualTags value=$blogEntry->getBlogTags()-|
     |-foreach from=$actualTags item=tag name=for_tag-|
    <li id="tagListItem|-$tag->getId()-|">
      <form  method="post"> 
        <input type="hidden" name="do" id="do" value="blogDoDeleteTagFromEntryX" /> 
        <input type="hidden" name="entryId"  value="|-$blogEntry->getId()-|" /> 
        <input type="hidden" name="tagId"  value="|-$tag->getId()-|" /> 
			  <input type="button" value="Eliminar" title="Eliminar" onClick="if (confirm('¿Seguro que desea eliminar el vínculo con la región?')){deleteTagFromEntry(this.form)}; return false" class="icon iconDelete" /> 
     </form><span title="Para eliminar haga click sobre el botón de la izquierda">&nbsp;&nbsp;&nbsp;|-$tag->getName()-|</span>
    </li> 
    |-/foreach-|
  </ul> 
</div>
</fieldset>
|-/if-|
|-/if-|

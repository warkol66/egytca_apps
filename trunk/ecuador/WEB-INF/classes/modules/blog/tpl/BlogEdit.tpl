<script type="text/javascript" src="scripts/lightbox.js"></script>
<script type="text/javascript">
	jQuery(function() {
        jQuery( ".datepicker" ).datepicker();
    });
</script>
<div id="lightbox1" class="leightbox"> 
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconDelete" /></a> 
	</p> 
	|-include file="BlogTagsEditX.tpl"-|
</div> 
<script src="Main.php?do=js&name=js&module=blog&code=|-$currentLanguageCode-|" type="text/javascript"></script>
|-include file='BlogEditTinyMceInclude.tpl' elements="blogEntry_body" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
<h2>##blog,1,Entradas##</h2>
<h1>|-if $action eq "edit"-|##blog,23,Editar entrada##|-else-|##blog,24,Crear entrada##|-/if-| </h1>
|-if $message eq "error"-|
	<div class="failureMessage">##blog,25,Ha ocurrido un error al intentar guardar la entrada##</div>
|-/if-|
<div id="div_blogEntry">
	<form name="form_edit_blogEntry" id="form_edit_blogEntry" action="Main.php" method="post">
		<p>##blog,26,Ingrese los datos de la entrada##</p>
		<fieldset title="##blog,27,Formulario de edición de datos de un noticia##">
		<legend>##blog,28,Formulario de Entrada##</legend>
			<p>
				<label for="blogEntry_title">##blog,10,Título##</label>
				<input name="blogEntry[title]" type="text" id="blogEntry_title" title="title" value="|-$blogEntry->gettitle()|escape-|" size="60" maxlength="255" />
			</p>
			<p>
				<label for="blogEntry_body">##blog,32,Texto de la entrada##</label>
				<textarea name="blogEntry[body]" cols="60" rows="15" wrap="VIRTUAL"  id="blogEntry_body">|-$blogEntry->getbody()|htmlentities-|</textarea>
		</p>
			<p>
				<label for="blogEntry_creationDate">##blog,35,Fecha de Creación##</label>
				<input name="blogEntry[creationDate]" type="text" id="blogEntry_creationDate" class="datepicker" title="creationDate" value="|-$blogEntry->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			|-assign var=entryId value=$blogEntry->getId()-|
			|-if not empty($entryId)-|
			<p>
				<label for="blogEntry_status">##blog,13,Estado##</label>
				<select name="blogEntry[status]">
					|-foreach from=$blogEntryStatus key=key item=name-|
						<option value="|-$key-|" |-if ($blogEntry->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
					|-/foreach-|
				</select>
			</p>
			|-/if-|
|-if $blogConfig.useCategories.value eq "YES"-|<p>
				<label for="blogEntry_categoryId">##blog,14,Categoría##</label>
				<select id="blogEntry_categoryId" name="blogEntry[categoryId]" title="categoryId">
					<option value="">##blog,18,Seleccione una categoría##</option>
									|-foreach from=$categoryIdValues item=object-|
									<option value="|-$object->getid()-|" |-if $blogEntry->getcategoryId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
									|-/foreach-|
								</select>
		</p>|-/if-|
			<p>
				<label for="blogEntry_userId">##blog,38,Usuario##</label>
				<select id="blogEntry_userId" name="blogEntry[userId]" title="userId">
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
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="blogEntry_id" value="|-$blogEntry->getid()-|" />
				|-/if-|
				
			<p>	
				<!--pasaje de parametros de filtros -->
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="doEdit" value="blogDoEdit" />
				<input type="button" id="button_edit_blogEntry" name="button_edit_blogEntry" title="##blog,40,Guardar##" value="##blog,40,Guardar##" onClick="javascript:submitEntryCreation(this.form)"  />			<input type="button" id="button_return_project" name="button_return_project" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=blogList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />

				<input type="button" id="button_edit_blogEntry" name="button_edit_blogEntry" title="##blog,42,Vista previa en listado##" value="##blog,42,Vista previa en listado##" onClick="javascript:submitPreviewOnHome(this.form)"/>
	|-if $blogConfig.bodyOnArticlesShow.value eq "NO"-|<input type="button" id="button_edit_blogEntry" name="button_edit_blogEntry" title="##blog,41,Vista previa del detalle##" value="##blog,41,Vista previa del detalle##" onClick="javascript:submitPreviewDetailed(this.form)"  />|-/if-|
			</p>
			<p>
			</p>
		</fieldset>
	</form>
</div>
|-if $blogConfig.useCommets.value eq "YES" && $action eq 'edit'-|	<div>
		<fieldset>
			<form action="Main.php" method="get">
				<input type="hidden" name="entryId" value="|-$blogEntry->getId()-|" id="entryId" />
				<input type="hidden" name="do" value="blogCommentsList" />
				<input type="submit" value="Ver comentarios asociados a este artículo" />
			</form>
		</fieldset>
	</div>
|-/if-|
|-if $action eq 'edit'-|
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
			<a href="#lightbox1" rel="lightbox1" class="lbOn addNew">Agregar nueva etiqueta</a>
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

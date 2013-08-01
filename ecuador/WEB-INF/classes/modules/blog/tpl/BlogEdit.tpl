|-if !is_object($blogEntry)-|
<div>Entrada no encontrada, puede que haya sido eliminada o esté incorrectamente identificada.<br />
Puede regresar a la página principal del blog haciendo click <a href="Main.php?do=blogList">aquí</a></div>
|-else-|
<link type="text/css" href="css/smoothness/jquery-ui-1.8.19.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="scripts/jquery/jquery-ui-1.8.19.custom.min.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
	//var galleryOptions; 
	
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
<h2>Experiencias</h2>
<h1>|-if !$blogEntry->isNew()-|Editar|-else-|Crear|-/if-| experiencia</h1>
|-if $message eq "ok"-|
	<div class="successMessage">Experiencia guardada correctamente</div>
|-elseif $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar la experiencia</div>
|-/if-|
<div id="div_blogEntry">
	<form name="form_edit_blogEntry" id="form_edit_blogEntry" action="Main.php" method="post">
		<p>Ingrese los datos de la experiencia</p>
		<fieldset title="Formulario de edición de datos de una experiencia">
		<legend>Formulario de Experiencia</legend>
			<p>
				<label for="params_title">Título</label>
				<input name="params[title]" type="text" id="params_title" title="title" value="|-$blogEntry->gettitle()|escape-|" size="60" maxlength="255" />
			</p>
			<p>
				<label for="params_body">Descripción</label>
				<textarea name="params[body]" cols="60" rows="15" wrap="VIRTUAL"  id="params_body">|-$blogEntry->getbody()|htmlentities-|</textarea>
		</p>
<p>Ficha de experiencia</p>
<div>
			<p>
				<label for="params_parish">Parroquia</label>
				<textarea name="params[parish]" cols="60" rows="2" wrap="VIRTUAL" id="params_parish">|-$blogEntry->getparish()|escape-|</textarea>
		</p>
			<p>
				<label for="params_canton">Cantón</label>
				<textarea name="params[canton]" cols="60" rows="2" wrap="VIRTUAL" id="params_canton">|-$blogEntry->getcanton()|escape-|</textarea>
		</p>
			<p>
				<label for="params_authority">Autoridad</label>
				<textarea name="params[authority]" cols="60" rows="2" wrap="VIRTUAL" id="params_authority">|-$blogEntry->getauthority()|escape-|</textarea>
		</p>
			<p>
				<label for="params_experience">Experiencia</label>
				<textarea name="params[experience]" cols="60" rows="2" wrap="VIRTUAL" id="params_authority">|-$blogEntry->getexperience()|escape-|</textarea>
		</p>
			<p>
				<label for="params_actors">Actores</label>
				<textarea name="params[actors]" cols="60" rows="3" wrap="VIRTUAL" id="params_actors">|-$blogEntry->getactors()|escape-|</textarea>
		</p>
			<p>
				<label for="params_populationServed">Población beneficiada</label>
				<textarea name="params[populationServed]" cols="60" rows="2" wrap="VIRTUAL" id="params_populationServed">|-$blogEntry->getPopulationServed()|escape-|</textarea>
		</p>
			<p>
				<label for="params_target">Objetivo</label>
				<textarea name="params[target]" cols="60" rows="6" wrap="VIRTUAL" id="params_target">|-$blogEntry->gettarget()|escape-|</textarea>
		</p>
			<p>
				<label for="params_actions">Acciones</label>
				<textarea name="params[actions]" cols="60" rows="6" wrap="VIRTUAL" id="params_actions">|-$blogEntry->getactions()|escape-|</textarea>
		</p>
			<p>
				<label for="params_results">Resultados</label>
				<textarea name="params[results]" cols="60" rows="3" wrap="VIRTUAL" id="params_results">|-$blogEntry->getresults()|escape-|</textarea>
		</p>
			<p>
				<label for="params_replica">Replica</label>
				<textarea name="params[replica]" cols="60" rows="3" wrap="VIRTUAL" id="params_replica">|-$blogEntry->getreplica()|escape-|</textarea>
		</p>
			<p>
				<label for="params_result">Conclusión</label>
				Se considera exitosa <input name="params[result]" type="radio" value="1" |-$blogEntry->getResult()|checked:"1"-|> 
				&nbsp; No fue exitosa <input name="params[result]" type="radio" value="0" |-$blogEntry->getResult()|checked:"0"-|>
		</p>
</div>
			<p>
				<label for="params_creationDate">Fecha de Creación</label>
				<input name="params[creationDate]" type="date" id="params_creationDate" class="datepicker" title="creationDate" value="|-$blogEntry->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
			</p>
			|-assign var=entryId value=$blogEntry->getId()-|
			|-if not empty($entryId)-|
			<p>
				<label for="params_status">Estado</label>
				<select name="params[status]" id="params_status">
					|-foreach from=$blogEntryStatus key=key item=name-|
						<option value="|-$key-|" |-if ($blogEntry->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
					|-/foreach-|
				</select>
			</p>
			|-/if-|
|-if $blogConfig.useCategories.value eq "YES"-|<p>
				<label for="params_categoryId">Categoría</label>
				<select id="params_categoryId" name="params[categoryId]" title="categoryId">
					<option value="">Seleccione una categoría</option>
									|-foreach from=$categoryIdValues item=object-|
									<option value="|-$object->getid()-|" |-if $blogEntry->getcategoryId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
									|-/foreach-|
								</select>
		</p>|-/if-|
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
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					
				<input type="hidden" name="action" id="action" value=|-if !$blogEntry->isNew()-|"edit"|-else-|"create"|-/if-| />
				<input type="hidden" name="do" id="doEdit" value="blogDoEdit" />
				<input type="button" id="button_edit_blogEntry" name="button_edit_blogEntry" title="##blog,40,Guardar##" value="##blog,40,Guardar##" onClick="javascript:submitEntryCreation(this.form)"  />			<input type="button" id="button_return_project" name="button_return_project" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=blogList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
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
<!--Upload de documentos-->
|-include file="BlogEditDocumentsInclude.tpl" path=$path blogEntryDocumentColl=$documents photos=$photos id=$blogEntry->getId()  edit=true-|
<!--Fin Upload de documentos-->
<!--Etiquetas-->
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
<!--Fin Etiquetas-->
|-/if-|
<input type="button" id="button_return_project" name="button_return_project" title="Volver" value="Volver al Listado" onClick="location.href='Main.php?do=blogList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
|-/if-|

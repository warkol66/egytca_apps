<script src="Main.php?do=js&name=js&module=news&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$.datepicker.setDefaults(jQuery.datepicker.regional['es']);
        $( ".creation, .file" ).datepicker({
			dateFormat:"dd-mm-yy"
		});
	});//fin docready
</script>
|-include file='NewsArticlesEditTinyMceInclude.tpl' elements="newsarticle_body" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
<h2>##news,1,Noticias##</h2>
|-if !is_object($newsArticle)-|
<div>Noticia no encontrada, puede que haya sido eliminada o esté incorrectamente identificada.<br />
Puede regresar a la página principal de noticias haciendo click <a href="Main.php?do=newsArticlesList">aquí</a></div>
|-else-|
<h1>|-if !$newsArticle->isNew()-|##news,23,Editar Noticia##|-else-|##news,24,Crear Noticia##|-/if-| </h1>
|-if $message eq "error"-|
	<div class="failureMessage">##news,25,Ha ocurrido un error al intentar guardar la noticia##</div>
|-/if-|
<div id="div_newsarticle">
	<form name="form_edit_newsarticle" id="form_edit_newsarticle" action="Main.php" method="post">
		<p>##news,26,Ingrese los datos del noticia##</p>
		<fieldset title="##news,27,Formulario de edición de datos de un noticia##">
		<legend>##news,28,Formulario de Noticias##</legend>
			<p>
				<label for="params_title">##news,10,Título##</label>
				<input name="params[title]" type="text" id="params_title" title="title" value="|-$newsArticle->gettitle()|escape-|" size="60" maxlength="255" />
			</p>
|-if $newsArticlesConfig.useTopTitle.value eq "YES"-|<p>
				<label for="params_topTitle">##news,29,Volanta##</label>
				<textarea name="params[topTitle]" cols="60" rows="2" wrap="VIRTUAL" id="params_topTitle">|-$newsArticle->gettopTitle()|escape-|</textarea>
			</p>|-/if-|
|-if $newsArticlesConfig.useSubTitle.value eq "YES"-|<p>
			<label for="params_subTitle">##news,30,Bajada##</label>
				<textarea name="params[subTitle]" cols="60" rows="3" wrap="VIRTUAL" id="params_subTitle">|-$newsArticle->getsubTitle()|escape-|</textarea>
			</p>|-/if-|
|-if $newsArticlesConfig.useSummary.value eq "YES"-|<p>
				<label for="params_summary">##news,31,Resumen##</label>
				<textarea name="params[summary]" cols="60" rows="4" wrap="VIRTUAL" id="params_summary">|-$newsArticle->getsummary()|escape-|</textarea>
			</p>|-/if-|
			<p>
				<label for="params_body">##news,32,Texto de la nota##</label>
				<textarea name="params[body]" cols="60" rows="15" wrap="VIRTUAL" class="tinymce" id="params_body">|-$newsArticle->getbody()|htmlentities-|</textarea>
		</p>
|-if $newsArticlesConfig.useSource.value eq "YES"-|<p>
				<label for="params_source">##news,33,Fuente##</label>
				<input name="params[source]" type="text" id="params_source" title="source" value="|-$newsArticle->getsource()-|" size="45" maxlength="255" />
			</p>
			<p>
				<label for="newsarticle_sourceContact">##news,34,Contatar a fuente##</label>
				<input name="params[sourceContact]" type="text" id="params_sourceContact" title="sourceContact" value="|-$newsArticle->getsourceContact()|escape-|" size="60" maxlength="150" />
			</p>|-/if-|
			<p>
				<label for="newsarticle_creationDate">##news,35,Fecha de Creación##</label>
				<input name="params[creationDate]" type="date" id="params_creationDate" class="creation" title="creationDate" value="|-$newsArticle->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			<p>
				<label for="newsarticle_archiveDate">##news,36,Fecha de Archivo##</label>
				<input name="params[archiveDate]" type="date" id="params_archiveDate" class="file" title="archiveDate" value="|-$newsArticle->getarchiveDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
			</p>
			|-assign var=newsid value=$newsArticle->getId()-|
			|-if not empty($newsid)-|
			<p>
				<label for="newsarticle_status">##news,13,Estado##</label>
				<select name="params[status]">
					|-foreach from=$newsArticleStatus key=key item=name-|
						<option value="|-$key-|" |-if ($newsArticle->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
					|-/foreach-|
				</select>
			</p>
			|-/if-|
|-if $newsArticlesConfig.useRegions.value eq "YES"-|<p>
				<label for="newsarticle_regionId">##news,15,Provincia##</label>
				<select id="params_regionId" name="params[regionId]" title="regionId">
					<option value="">##news,37,Seleccione una Provincia##</option>
									|-foreach from=$regionIdValues item=object-|
									<option value="|-$object->getid()-|" |-if $newsArticle->getregionId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
									|-/foreach-|
								</select>
		</p>|-/if-|
|-if $newsArticlesConfig.useCategories.value eq "YES"-|<p>
				<label for="newsarticle_categoryId">##news,14,Categoría##</label>
				<select id="params_categoryId" name="params[categoryId]" title="categoryId">
					<option value="">##news,18,Seleccione una categoría##</option>
									|-foreach from=$categoryIdValues item=object-|
									<option value="|-$object->getid()-|" |-if $newsArticle->getcategoryId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
									|-/foreach-|
								</select>
		</p>|-/if-|
			<p>
				<label for="newsarticle_userId">##news,38,Usuario##</label>
				<select id="params_userId" name="params[userId]" title="userId">
					<option value="">##news,39,Seleccione un Usuario##</option>
									|-foreach from=$userIdValues item=object-|
									<option value="|-$object->getid()-|" |-if $newsArticle->getuserId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getusername()-|</option>
									|-/foreach-|
								</select>
		</p>
				|-if is_object($newsArticle)-|
|-if $newsArticlesConfig.bodyOnArticlesShow.value eq "NO"-|<p>
				<label>Vistas</label> |-$newsArticle->getViews()-| veces
			</p>|-/if-|
				|-/if-|
				|-if !$newsArticle->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$newsArticle->getid()-|" />
				|-/if-|
				
			<p>	
				<!--pasaje de parametros de filtros -->
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="doEdit" value="newsArticlesDoEdit" />
				<input type="button" id="button_edit_newsarticle" name="button_edit_newsarticle" title="##news,40,Guardar##" value="##news,40,Guardar##" onClick="javascript:submitArticleCreation(this.form)"  />
				<input type="button" id="button_edit_newsarticle" name="button_edit_newsarticle" title="##news,42,Vista previa en listado##" value="##news,42,Vista previa en listado##" onClick="javascript:submitPreviewOnHome(this.form)"/>
	|-if $newsArticlesConfig.bodyOnArticlesShow.value eq "NO"-|<input type="button" id="button_edit_newsarticle" name="button_edit_newsarticle" title="##news,41,Vista previa del detalle##" value="##news,41,Vista previa del detalle##" onClick="javascript:submitPreviewDetailed(this.form)"  />|-/if-|
			</p>
			<p>
			</p>
		</fieldset>
	</form>
</div>
|*-if $newsArticlesConfig.useImages.value eq "YES" || $newsArticlesConfig.useAudio.value eq "YES" || $newsArticlesConfig.useVideo.value eq "YES"-*|
<div id="mediasListHolder">
	|-include file='NewsMediasListInclude.tpl'-|
</div>
	|-if !$newsArticle->isNew()-|
		|-include file='NewsMediasAddInclude.tpl' article=$newsArticle-|
	|-/if-|
|*-/if-*|
|-if $newsArticlesConfig.useCommets.value eq "YES" && !$newsArticle->isNew()-|	<div>
		<fieldset>
			<form action="Main.php" method="get">
				<input type="hidden" name="articleId" value="|-$newsArticle->getId()-|" id="articleId" />
				<input type="hidden" name="do" value="newsCommentsList" />
				<input type="submit" value="Ver comentarios asociados a este artículo" />
			</form>
		</fieldset>
	</div>
|-/if-|
|-/if-|

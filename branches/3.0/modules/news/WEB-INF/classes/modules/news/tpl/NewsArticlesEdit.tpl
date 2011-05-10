|-include file='NewsArticlesEditTinyMceInclude.tpl' elements="newsarticle_body" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
<h2>##news,1,Noticias##</h2>
<h1>|-if $action eq "edit"-|##news,23,Editar Noticia##|-else-|##news,24,Crear Noticia##|-/if-| </h1>
|-if $message eq "error"-|
	<div class="failureMessage">##news,25,Ha ocurrido un error al intentar guardar la noticia##</div>
|-/if-|
<div id="div_newsarticle">
	<form name="form_edit_newsarticle" id="form_edit_newsarticle" action="Main.php" method="post">
		<p>##news,26,Ingrese los datos del noticia##</p>
		<fieldset title="##news,27,Formulario de edición de datos de un noticia##">
		<legend>##news,28,Formulario de Noticias##</legend>
			<p>
				<label for="newsarticle_title">##news,10,Título##</label>
				<input name="newsarticle[title]" type="text" id="newsarticle_title" title="title" value="|-$newsarticle->gettitle()|escape-|" size="60" maxlength="255" />
			</p>
|-if $newsArticlesConfig.useTopTitle.value eq "YES"-|<p>
				<label for="newsarticle_topTitle">##news,29,Volanta##</label>
				<textarea name="newsarticle[topTitle]" cols="60" rows="2" wrap="VIRTUAL" id="newsarticle_topTitle">|-$newsarticle->gettopTitle()|escape-|</textarea>
			</p>|-/if-|
|-if $newsArticlesConfig.useSubTitle.value eq "YES"-|<p>
			<label for="newsarticle_subTitle">##news,30,Bajada##</label>
				<textarea name="newsarticle[subTitle]" cols="60" rows="3" wrap="VIRTUAL" id="newsarticle_subTitle">|-$newsarticle->getsubTitle()|escape-|</textarea>
			</p>|-/if-|
|-if $newsArticlesConfig.useSummary.value eq "YES"-|<p>
				<label for="newsarticle_summary">##news,31,Resumen##</label>
				<textarea name="newsarticle[summary]" cols="60" rows="4" wrap="VIRTUAL" id="newsarticle_summary">|-$newsarticle->getsummary()|escape-|</textarea>
			</p>|-/if-|
			<p>
				<label for="newsarticle_body">##news,32,Texto de la nota##</label>
				<textarea name="newsarticle[body]" cols="60" rows="15" wrap="VIRTUAL"  id="newsarticle_body">|-$newsarticle->getbody()|htmlentities-|</textarea>
		</p>
|-if $newsArticlesConfig.useSource.value eq "YES"-|<p>
				<label for="newsarticle_source">##news,33,Fuente##</label>
				<input name="newsarticle[source]" type="text" id="newsarticle_source" title="source" value="|-$newsarticle->getsource()-|" size="45" maxlength="255" />
			</p>
			<p>
				<label for="newsarticle_sourceContact">##news,34,Contatar a fuente##</label>
				<input name="newsarticle[sourceContact]" type="text" id="newsarticle_sourceContact" title="sourceContact" value="|-$newsarticle->getsourceContact()|escape-|" size="60" maxlength="150" />
			</p>|-/if-|
			<p>
				<label for="newsarticle_creationDate">##news,35,Fecha de Creación##</label>
				<input name="newsarticle[creationDate]" type="text" id="newsarticle_creationDate" title="creationDate" value="|-$newsarticle->getcreationDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('newsarticle[creationDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="newsarticle_archiveDate">##news,36,Fecha de Archivo##</label>
				<input name="newsarticle[archiveDate]" type="text" id="newsarticle_archiveDate" title="archiveDate" value="|-$newsarticle->getarchiveDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('newsarticle[archiveDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			|-assign var=newsid value=$newsarticle->getId()-|
			|-if not empty($newsid)-|
			<p>
				<label for="newsarticle_status">##news,13,Estado##</label>
				<select name="newsarticle[status]">
					|-foreach from=$newsArticleStatus key=key item=name-|
						<option value="|-$key-|" |-if ($newsarticle->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
					|-/foreach-|
				</select>
			</p>
			|-/if-|
|-if $newsArticlesConfig.useRegions.value eq "YES"-|<p>
				<label for="newsarticle_regionId">##news,15,Provincia##</label>
				<select id="newsarticle_regionId" name="newsarticle[regionId]" title="regionId">
					<option value="">##news,37,Seleccione una Provincia##</option>
									|-foreach from=$regionIdValues item=object-|
									<option value="|-$object->getid()-|" |-if $newsarticle->getregionId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
									|-/foreach-|
								</select>
		</p>|-/if-|
|-if $newsArticlesConfig.useCategories.value eq "YES"-|<p>
				<label for="newsarticle_categoryId">##news,14,Categoría##</label>
				<select id="newsarticle_categoryId" name="newsarticle[categoryId]" title="categoryId">
					<option value="">##news,18,Seleccione una categoría##</option>
									|-foreach from=$categoryIdValues item=object-|
									<option value="|-$object->getid()-|" |-if $newsarticle->getcategoryId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
									|-/foreach-|
								</select>
		</p>|-/if-|
			<p>
				<label for="newsarticle_userId">##news,38,Usuario##</label>
				<select id="newsarticle_userId" name="newsarticle[userId]" title="userId">
					<option value="">##news,39,Seleccione un Usuario##</option>
									|-foreach from=$userIdValues item=object-|
									<option value="|-$object->getid()-|" |-if $newsarticle->getuserId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getusername()-|</option>
									|-/foreach-|
								</select>
		</p>
				|-if $newsarticle neq ''-|
|-if $newsArticlesConfig.bodyOnArticlesShow.value eq "NO"-|<p>
				<label>Vistas</label> |-$newsarticle->getViews()-| veces
			</p>|-/if-|
				|-/if-|
				|-if $action eq "edit"-|
				<input type="hidden" name="newsarticle[id]" id="newsarticle_id" value="|-$newsarticle->getid()-|" />
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
|-if $newsArticlesConfig.useImages.value eq "YES" || $newsArticlesConfig.useAudio.value eq "YES" || $newsArticlesConfig.useVideo.value eq "YES"-|
<div id="mediasListHolder">
	|-include file='NewsMediasListInclude.tpl'-|
</div>
	|-if $action eq 'edit'-|
		|-include file='NewsMediasAddInclude.tpl' article=$newsarticle-|
	|-/if-|
|-/if-|
|-if $newsArticlesConfig.useCommets.value eq "YES" && $action eq 'edit'-|	<div>
		<fieldset>
			<form action="Main.php" method="get">
				<input type="hidden" name="articleId" value="|-$newsarticle->getId()-|" id="articleId" />
				<input type="hidden" name="do" value="newsCommentsList" />
				<input type="submit" value="Ver comentarios asociados a este artículo" />
			</form>
		</fieldset>
	</div>
|-/if-|

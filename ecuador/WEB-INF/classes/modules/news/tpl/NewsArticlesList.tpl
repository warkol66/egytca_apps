<script src="Main.php?do=js&name=js&module=blog&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script>
    $(function() {
		$.datepicker.setDefaults($.datepicker.regional['es']);
        $( ".datepickerFrom" ).datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerTo").datepicker("option", "minDate", selectedDate);
            }
		});
		$(".datepickerTo").datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerFrom").datepicker("option", "maxDate", selectedDate);
            }
		});
    });
</script>
<h2>##news,1,Noticias##</h2>
<h1>##news,2,NoticiasLista de Noticias##</h1>
<p>##news,3,A continuación se muestra el listado de noticias disponibles en el sistema, ud. podrá agregar nuevas noticias o eliminar las existente, así como publicar o archivar noticia.##</p>
<div id="newsArticlesFilters">
<form action="Main.php" method="get">
	<fieldset title="##news,7,Formulario de Opciones de búsqueda de noticias##">
		<legend>##news,4,Opciones de Búsqueda##</legend>
		<p>
			<label for="fromDate">##news,5,Fecha Desde##</label>
			<input name="filters[dateRange][creationdate][min]" type="text" id="filters_dateRange_min" class="datepickerFrom" title="fromDate" value="|-$filters.dateRange.creationdate.min|date_format:"%d-%m-%Y"-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
		</p>
		<p>
			<label for="toDate">##news,6,Fecha Hasta##</label>
			<input name="filters[dateRange][creationdate][max]" type="text" id="filters_dateRange_max" class="datepickerTo" title="toDate" value="|-$filters.dateRange.creationdate.max|date_format:"%d-%m-%Y"-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
		</p>
|-if $newsArticlesConfig.useCategories.value eq "YES"-|		<p>
			<label for="categoryId">##news,14,Categoría##</label>
			<select name='filters[categoryId]'>
					<option value=''>##news,18,Seleccione una categoría##</option>
				|-foreach from=$categories item=category name=from_categories-|
					<option value="|-$category->getId()-|" |-if $filters neq '' and $filters.categoryId eq $category->getId()-|selected="selected"|-/if-|>|-$category->getName()-|</option>
				|-/foreach-|
			</select>
		</p>|-/if-|
		<p>
			<input type="hidden" name="do" value="newsArticlesList" />
			<input type="submit" value="##news,8,Buscar##">
		</p>
	</fieldset>
</form>
</div>
<div id="divMsgBox"></div>
	|-if $message eq "ok"-|
		<div class="successMessage">##news,19,Noticia guardada correctamente##</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##news,20,Noticia eliminada correctamente##</div>
	|-elseif $message eq "changed"-|
	<div class="successMessage">##news,21,Estados modificados correctamente##</div>
	|-/if-|
|-assign var="colSpan" value=6-|
|-if $newsArticlesConfig.useRegions.value eq "YES"-||-assign var="colSpan" value=$colSpan+1-||-/if-|
|-if $newsArticlesConfig.useCategories.value eq "YES"-||-assign var="colSpan" value=$colSpan+1-||-/if-|
<div id="div_newsarticles">
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsarticles">
		<thead>
			<tr>
				<th colspan="|-$colSpan-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newsArticlesEdit" class="addLink">##news,9,Agregar Noticia##</a></div></th>
			</tr>
			<tr>
				<th width="2%"><input type="checkbox" name="allbox" value="checkbox" id="allBoxes" onChange="javascript:selectAllCheckboxes()" title="Seleccionar todos" />
				</th>
				<th width="40%">##news,10,Título##</th>
				<th width="8%">##news,11,Fecha##</th>
				<th width="8%">##news,12,Archivar##</th>
|-if $newsArticlesConfig.useRegions.value eq "YES"-|<th width="12%">##news,15,Provincia##</th>|-/if-|
|-if $newsArticlesConfig.useCategories.value eq "YES"-|<th width="12%">##news,14,Categoría##</th>|-/if-|
				<th width="15%">##news,13,Estado##</th>
				<th width="2%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$newsArticleColl item=newsarticle name=for_newsarticles-|
			<tr>
				<td><input type="checkbox" name="selected[]" value="|-$newsarticle->getId()-|"></td>
				<td>|-$newsarticle->gettitle()-|</td>
				<td>|-$newsarticle->getcreationDate()|date_format:"%d-%m-%Y"-|</td>
				<td>
					|-assign var=archiveDate value=$newsarticle->getarchiveDate()-|
					|-if empty($archiveDate)-|No archivada|-else-||-$archiveDate|date_format:"%d-%m-%Y"-||-/if-|
				</td>
|-if $newsArticlesConfig.useRegions.value eq "YES"-|<td>
					|-assign var=region value=$newsarticle->getRegion()-|
					|-if empty($region)-|N/A|-else-||-$region->getName()-||-/if-|
				</td>|-/if-|
|-if $newsArticlesConfig.useCategories.value eq "YES"-|<td>
					|-assign var=category value=$newsarticle->getCategory()-|
					|-if empty($category)-|N/A|-else-||-$category->getName()-||-/if-|
				</td>|-/if-|
			<td>|-if "newsArticlesChangeStatusX"|security_user_has_access-|	
						<form action="Main.php" method="post" id="formStatusNewsArticle|-$newsarticle->getId()-|">
							<select name="newsarticle[status]" id="selectStatusArticle|-$newsarticle->getId()-|" onChange="javascript:submitNewsChangeFormX('formStatusNewsArticle|-$newsarticle->getId()-|')">
								|-foreach from=$newsArticleStatus key=key item=name-|
									<option value="|-$key-|" |-if ($newsarticle->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
								|-/foreach-|
							</select>											
							<input type="hidden" name="newsarticle[id]" id="newsarticle_id" value="|-$newsarticle->getid()-|" />
							<input type="hidden" name="do" value="newsArticlesChangeStatusX" id="do">
						</form>
				|-else-|
					|-assign var=articleStatus value=$newsarticle->getStatus()-|
					|-$newsArticleStatus[$articleStatus]-|
				|-/if-|
				</td>								
				<td nowrap>|-if "newsArticlesChangeStatusX"|security_user_has_access || "newsArticlesChangeStatuses"|security_user_has_access || $articleStatus eq 1-|
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="newsArticlesEdit" />
						<input type="hidden" name="id" value="|-$newsarticle->getid()-|" />
						<input type="submit" name="submit_go_edit_newsarticle" value="##common,1,Editar##" title="##common,1,Editar##" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="newsArticlesDoDelete" />
						<input type="hidden" name="id" value="|-$newsarticle->getid()-|" />
						<input type="submit" name="submit_go_delete_newsarticle" value="##common,2,Eliminar##" title="##common,2,Eliminar##" onclick="return confirm('##news,22,Seguro que desea eliminar el newsarticle?##')" class="icon iconDelete" />
					</form>
					|-else-|
					
					|-/if-|
				</td>
			</tr>
		|-/foreach-|
		|-if $newsarticles|@count neq 0 && "newsArticlesChangeStatuses"|security_user_has_access-|
			<tr>
				<td colspan="|-$colSpan-|">
					<form action="Main.php" method="post" id='multipleArticlesChangeForm'>
						<p>##news,16,Cambiar los Artículos seleccionados al estado##
							<select name="status" id="selectStatusArticle|-$newsarticle->getId()-|">
							|-foreach from=$newsArticleStatus key=key item=name-|
								<option value="|-$key-|" |-if ($newsarticle->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
							|-/foreach-|
							</select>
							|-if isset($pager)-|
								<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
							|-/if-|
							<input type="hidden" name="do" value="newsArticlesChangeStatuses" id="do">
							<input type="button" onClick="javascript:submitMultipleArticlesChangeFormX('multipleArticlesChangeForm')" value="##news,17,Cambiar Estado##" title="##news,17,Cambiar Estado##" class="button">
						</p>
					</form>
				</td>
			</tr>
		|-/if-|
		|-if isset($pager) && ($pager->getLastPage() gt 1)-|
			<tr> 
				<td colspan="|-$colSpan-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				<th colspan="|-$colSpan-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newsArticlesEdit" class="addLink">##news,9,Agregar Noticia##</a></div></th>
			</tr>
		</tbody>
	</table>
</div>

<script src="Main.php?do=js&name=js&module=news&code=|-$currentLanguageCode-|" type="text/javascript"></script>
<script>
    $(function() {
		$.datepicker.setDefaults($.datepicker.regional['es']);
        $( ".datepickerFrom" ).datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerTo").datepicker("option", "minDate", selectedDate);
            }
		}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');
		$(".datepickerTo").datepicker({
			dateFormat:"dd-mm-yy",
			onClose: function(selectedDate) {
                $(".datepickerFrom").datepicker("option", "maxDate", selectedDate);
            }
		}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');
    });
</script>
<h2>Comentarios</h2>
<h1>Administrar Comentarios</h1>
<p>A continuación puede ver los comentarios creados por los visitantes al sitio, puede eliminar los comentarios que desee haciendo click en eliminar.</p>
<div id="divMsgBox">
</div>
				
<div id="div_comments_messages">
	|-if $message eq "ok"-|<div class="successMessage">Comentario guardado correctamente</div>|-/if-|
	|-if $message eq "deleted_ok"-|<div class="successMessage">Comentario eliminado correctamente</div>|-/if-|
	|-if $message eq "changed"-|<div class="successMessage">Estados modificados correctamente</div>|-/if-|
</div>

|-if isset($articleId)-|
<div id="div_navigation">
	<fieldset>
		<form action="Main.php" method="get">
			<input type="hidden" name="do" value="newsArticlesEdit" id="do"/>
			<input type="hidden" name="id" value="|-$articleId-|" id="id">
			<p><input type="submit" value="Volver a Edición de Noticia"></p>
		</form>
	</fieldset>
</div>
|-/if-|

<div id="div_newscomments_filters">
	<fieldset>
			<legend>Filtros de Comentarios</legend>
			<form action="Main.php" method="get">
				
				<p>
					<label>Estado Comentarios</label>
					<select name="filters[status]">
						<option value="">Todos</option>
						<option value="1" |-if isset($filters.status) and ($filters.status eq 1)-|selected="selected"|-/if-|>Pendiente</option>
						<option value="2" |-if isset($filters.status) and ($filters.status eq 2)-|selected="selected"|-/if-|>Aprobado</option>
						<option value="3" |-if isset($filters.status) and ($filters.status eq 3)-|selected="selected"|-/if-|>Spam</option>
						<option value="4" |-if isset($filters.status) and ($filters.status eq 4)-|selected="selected"|-/if-|>Eliminado</option>
					</select>
				</p>
				<p>
					<label for="fromDate">Fecha Desde</label>
					<input name="filters[dateRange][creationdate][min]" type="text" id="filters_dateRange_min" class="datepickerFrom" title="fromDate" value="|-$filters.dateRange.creationdate.min|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
				</p>
				<p>
					<label for="toDate">Fecha Hasta</label>
					<input name="filters[dateRange][creationdate][max]" type="text" id="toDate" class="datepickerTo" title="toDate" value="|-$filters.dateRange.creationdate.max|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
				</p>
				|-if not isset($articleId)-|
				<p>
					<label for="newsArticleId">Artículos</label>
					<select name='filters[newsarticleid]'>
							<option value=''>Seleccione un Artículo</option>
						|-foreach from=$articles item=article name=from_categories-|
							<option value="|-$article->getId()-|" |-if $filters neq '' and $filters.articleId eq $article->getId()-|selected="selected"|-/if-|>|-$article->getTitle()|mb_truncate:60:"...":'UTF-8':true-|</option>
						|-/foreach-|
					</select>
				</p>
				|-/if-|
				|-if isset($articleId)-|
					<input type="hidden" name="articleId" value="|-$articleId-|" id="articleId"/>
				|-/if-|
					<input type="hidden" name="do" value="newsCommentsList" id="do">
					<input type="submit" value="Aplicar Filtro">
				</p>
			</form>
	</fieldset>
</div>

<div id="div_newscomments">
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newscomments">
		<thead>
	|-if not isset($articleId)-|
			<tr>
				<th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newsCommentsEdit" class="addLink">Agregar Comentario</a></div></th>
			</tr>
	|-/if-|
			<tr>
				<th width="2%"><input type="checkbox" name="allbox" value="checkbox" id="allBoxes" onChange="javascript:selectAllCheckboxes()" title="Seleccionar todos" />
				</th>
				<th>Artículo</th>
				<th>Comentario</th>
				<th>Email</th>
				<th>Nombre de Usuario</th>
				<th>Fecha y Hora </th>
<!--							<th>userId</th> -->
				<th>Estado</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$newsCommentColl item=newscomment name=for_newscomments-|
			<tr>
	
				|-assign var=article value=$newscomment->getNewsArticle()-|
				<td>
					<input type="checkbox" name="selected[]" value="|-$newscomment->getId()-|" />
				</td>
				|-if is_object($article)-|
				<td>|-$article->getTitle()-|</td>
				|-else-|
				<td></td>
				|-/if-|
				<td>|-$newscomment->gettext()-|</td>
				<td>|-$newscomment->getemail()-|</td>
				<td>|-$newscomment->getusername()-|</td>
				<td>|-$newscomment->getcreationDate()-|</td>
	<!--																<td>|-$newscomment->getUserId()-|</td> -->
				<td>
					|-assign var=status value=$newscomment->getStatus()-|
	
					<form action="Main.php" method="post" id="formStatusComment|-$newscomment->getId()-|">
						<select name="params[status]" onChange="javascript:submitCommentsChangeFormX('formStatusComment|-$newscomment->getId()-|')" id='newsCommentsStatusSelect|-$newscomment->getId()-|'>
							<option value="1" |-if isset($status) and ($status eq 1)-|selected="selected"|-/if-|>Pendiente</option>
							<option value="2" |-if isset($status) and ($status eq 2)-|selected="selected"|-/if-|>Aprobado</option>
							<option value="3" |-if isset($status) and ($status eq 3)-|selected="selected"|-/if-|>Spam</option>
							<option value="4" |-if isset($status) and ($status eq 4)-|selected="selected"|-/if-|>Eliminado</option>
						</select>
						<input type="hidden" name="id" id="id" value="|-$newscomment->getid()-|" />
						<input type="hidden" name="do" value="newsCommentsChangeStatusX" id="do">
					</form>
				</td>
				<td nowrap>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="newsCommentsEdit" />
						<input type="hidden" name="id" value="|-$newscomment->getid()-|" />
						<input type="submit" name="submit_go_edit_newscomment" value="Editar" class="icon iconEdit" />
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($articleId)-|
							<input type="hidden" name="articleId" value="|-$articleId-|" id="articleId"/>
						|-/if-|
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="newsCommentsDoDelete" />
						<input type="hidden" name="id" value="|-$newscomment->getid()-|" />
						<input type="submit" name="submit_go_delete_newscomment" value="Borrar" onclick="return confirm('Seguro que desea eliminar el comentario?')" class="icon iconDelete" />
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($articleId)-|
							<input type="hidden" name="articleId" value="|-$articleId-|" id="articleId"/>
						|-/if-|
					</form>
				</td>
			</tr>
		|-/foreach-|						

		<tr>
			<td colspan="9">								
				<form action="Main.php" method="post" id='multipleCommentsChangeForm'>
					<p>
						Cambiar los Comentarios seleccionados al estado 
						<select name="status">
							<option value="1">Pendientes</option>
							<option value="2">Aprobados</option>
							<option value="3">Spam</option>
							<option value="4">Eliminados</option>
						</select>
						<input type="hidden" name="do" value="newsCommentsChangeStatuses" id="newsCommentsChangeStatusX">
						|-if isset($pager)-|
							<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
						|-/if-|
						<input type="button" onClick="javascript:submitMultipleCommentsChangeFormX('multipleCommentsChangeForm')" value="Cambiar Estado">
						</p>
				</form>
			</td>
		</tr>							
						
	|-if isset($pager) && ($pager->getLastPage() gt 1)-|
		<tr> 
			<td colspan="9" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>							
	|-/if-|						
	|-if not isset($articleId)-|
			<tr>
				<th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newsCommentsEdit" class="addLink">Agregar Comentario</a></div></th>
			</tr>
	|-/if-|				
		</tbody>
	</table>
</div>

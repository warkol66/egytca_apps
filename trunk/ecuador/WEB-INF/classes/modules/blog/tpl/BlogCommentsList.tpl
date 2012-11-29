<script type="text/javascript" src="scripts/blog.js"></script>
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
<h2>Comentarios</h2>
<h1>Administrar Comentarios</h1>
<p>A continuación puede ver los comentarios creados por los visitantes al sitio, puede eliminar los comentarios que desee haciendo click en eliminar.</p>

<!--div id="divMsgBox">
</div-->
				
<div id="div_comments_messages">
	|-if $message eq "ok"-|<div class="successMessage">Comentario guardado correctamente</div>|-/if-|
	|-if $message eq "deleted_ok"-|<div class="successMessage">Comentario eliminado correctamente</div>|-/if-|
	|-if $message eq "changed"-|<div class="successMessage">Estados modificados correctamente</div>|-/if-|
</div>

|-if isset($entryId)-|
<div id="div_navigation">
	<fieldset>
		<form action="Main.php" method="get">
			<input type="hidden" name="do" value="blogEdit" id="do"/>
			<input type="hidden" name="id" value="|-$entryId-|" id="id">
			<p><input type="submit" value="Volver a Edición de Entrada"></p>
		</form>
	</fieldset>
</div>
|-/if-|

<div id="div_blogComments_filters">
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
					<label for="fromDate">##blog,5,Fecha Desde##</label>
					<input name="filters[fromDate]" type="text" id="fromDate" class="datepickerFrom" title="fromDate" value="|-$filters.fromDate|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0"  title="Seleccione la fecha">
				</p>
				<p>
					<label for="toDate">##blog,6,Fecha Hasta##</label>
					<input name="filters[toDate]" type="text" id="toDate" class="datepickerTo" title="toDate" value="|-$filters.toDate|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
				</p>
				|-if not isset($entryId)-|
				<p>
					<label for="articleId">Entradas</label>
					<select name='filters[entryid]' title="Seleccione una entrada de los últimas 50 publicadas">
							<option value=''>Seleccione una entrada</option>
						|-foreach from=$entries item=entry name=from_entries-|
							<option value="|-$entry->getId()-|" |-if $filters neq '' and $filters.entryid eq $entry->getId()-|selected="selected"|-/if-|>|-$entry->getTitle()|mb_truncate:60:"...":'UTF-8':true-|</option>
						|-/foreach-|
					</select>
				</p>
				|-/if-|
				|-if isset($entryId)-|
					<input type="hidden" name="entryId" value="|-$entryId-|" id="entryId"/>
				|-/if-|
					<input type="hidden" name="do" value="blogCommentsList" id="do">
					<input type="submit" value="Aplicar Filtro">
				</p>
			</form>
	</fieldset>
</div>

<div id="divMsgBox">
</div>
<div id="div_blogComments">
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-blogComments">
		<thead>
	|-if not isset($entryId)-|
			<tr>
				<th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=blogCommentsEdit" class="addLink">Agregar Comentario</a></div></th>
			</tr>
	|-/if-|
			<tr>
				<th><input type="checkbox" name="allbox" value="checkbox" id="allBoxes" onChange="javascript:selectAllCheckboxes()" title="Seleccionar todos" /></th>
				<th>Entrada</th>
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
		|-foreach from=$blogCommentColl item=blogComment name=for_blogComments-|
			|-assign var=entry value=$blogComment->getBlogEntry()-|
			|-if is_object($entry)-|
			<tr>	
				<td>
					<input type="checkbox" name="selected[]" value="|-$blogComment->getId()-|" />
				</td>
				<td>|-$entry->getTitle()-|</td>
				<td>|-$blogComment->gettext()-|</td>
				<td>|-$blogComment->getemail()-|</td>
				<td>|-$blogComment->getusername()-|</td>
				<td>|-$blogComment->getcreationDate()|date_format:"%d-%m-%Y"-|</td>
				<!-- <td>|-$blogComment->getUserId()-|</td> -->
				<td>
					|-assign var=status value=$blogComment->getstatus()-|
	
					<form action="Main.php" method="post" id="formStatusComment|-$blogComment->getId()-|">
						<select name="params[status]" onChange="javascript:submitCommentsChangeFormX('formStatusComment|-$blogComment->getId()-|')" id='blogCommentsStatusSelect|-$blogComment->getId()-|'>
							<option value="1" |-if isset($status) and ($status eq 1)-|selected="selected"|-/if-|>Pendiente</option>
							<option value="2" |-if isset($status) and ($status eq 2)-|selected="selected"|-/if-|>Aprobado</option>
							<option value="3" |-if isset($status) and ($status eq 3)-|selected="selected"|-/if-|>Spam</option>
							<option value="4" |-if isset($status) and ($status eq 4)-|selected="selected"|-/if-|>Eliminado</option>
						</select>
						<input type="hidden" name="id" id="id" value="|-$blogComment->getid()-|" />
						<input type="hidden" name="do" value="blogCommentsChangeStatusX" id="do">
					</form>
				</td>
				<td nowrap>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="blogCommentsEdit" />
						<input type="hidden" name="id" value="|-$blogComment->getid()-|" />
						<input type="submit" name="submit_go_edit_blogComment" value="Editar" class="buttonImageEdit" />
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($articleId)-|
							<input type="hidden" name="articleId" value="|-$articleId-|" id="articleId"/>
						|-/if-|
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="blogCommentsDoDelete" />
						<input type="hidden" name="id" value="|-$blogComment->getid()-|" />
						<input type="submit" name="submit_go_delete_blogComment" value="Borrar" onclick="return confirm('Seguro que desea eliminar el comentario?')" class="buttonImageDelete" />
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($articleId)-|
							<input type="hidden" name="articleId" value="|-$articleId-|" id="articleId"/>
						|-/if-|
					</form>
				</td>
			</tr>
			|-/if-|
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
						<input type="hidden" name="do" value="blogCommentsChangeStatuses" id="blogCommentsChangeStatusX">
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
			<td colspan="9" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>							
	|-/if-|						
	|-if not isset($articleId)-|
			<tr>
				<th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=blogCommentsEdit" class="addLink">Agregar Comentario</a></div></th>
			</tr>
	|-/if-|				
		</tbody>
	</table>
</div>

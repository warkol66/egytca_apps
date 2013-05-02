<script type="text/javascript" src="scripts/board.js"></script>
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
	|-if $noChallenge eq true-|<div class="errorMessage">La consigna que comentó no existe, el comentario no aparecerá en la lista</div>|-/if-|
</div>

|-if isset($challengeId)-|
<div id="div_navigation">
	<fieldset>
		<form action="Main.php" method="get">
			<input type="hidden" name="do" value="boardEdit" id="do"/>
			<input type="hidden" name="id" value="|-$challengeId-|" id="id">
			<p><input type="submit" value="Volver a Edición de Consigna"></p>
		</form>
	</fieldset>
</div>
|-/if-|

<div id="div_boardComments_filters">
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
					<label for="fromDate">##board,5,Fecha Desde##</label>
					<input name="filters[dateRange][creationdate][min]" type="text" id="filters_dateRange_min" class="datepickerFrom" title="fromDate" value="|-$filters.dateRange.creationdate.min|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0"  title="Seleccione la fecha">
				</p>
				<p>
					<label for="toDate">##board,6,Fecha Hasta##</label>
					<input name="filters[dateRange][creationdate][max]" type="text" id="filters_dateRange_max" class="datepickerTo" title="toDate" value="|-$filters.dateRange.creationdate.max|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
				</p>
				|-if not isset($challengeId)-|
				<p>
					<label for="articleId">Consignas</label>
					<select name='filters[challengeid]' title="Seleccione una entrada de los últimas 50 publicadas">
							<option value=''>Seleccione una consigna</option>
						|-foreach from=$challenges item=challenge name=from_challenges-|
							<option value="|-$challenge->getId()-|" |-if $filters neq '' and $filters.challengeid eq $challenge->getId()-|selected="selected"|-/if-|>|-$challenge->getTitle()|mb_truncate:60:"...":'UTF-8':true-|</option>
						|-/foreach-|
					</select>
				</p>
				|-/if-|
				|-if isset($challengeId)-|
					<input type="hidden" name="challengeId" value="|-$challengeId-|" id="challengeId"/>
				|-/if-|
					<input type="hidden" name="do" value="boardCommentsList" id="do">
					<input type="submit" value="Aplicar Filtro">
				</p>
			</form>
	</fieldset>
</div>

<div id="divMsgBox">
</div>
<div id="div_boardComments">
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-boardComments">
		<thead>
	|-if not isset($challengeId)-|
			<tr>
				<th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=boardCommentsEdit" class="addLink">Agregar Comentario</a></div></th>
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
		|-foreach from=$boardCommentColl item=boardComment name=for_boardComments-|
			|-assign var=challenge value=$boardComment->getBoardChallenge()-|
			|-if is_object($challenge)-|
			<tr>	
				<td>
					<input type="checkbox" name="selected[]" value="|-$boardComment->getId()-|" />
				</td>
				<td>|-$challenge->getTitle()-|</td>
				<td>|-$boardComment->gettext()-|</td>
				<td>|-$boardComment->getemail()-|</td>
				<td>|-$boardComment->getusername()-|</td>
				<td>|-$boardComment->getcreationDate()|date_format:"%d-%m-%Y"-|</td>
				<!-- <td>|-$boardComment->getUserId()-|</td> -->
				<td>
					|-assign var=status value=$boardComment->getstatus()-|
	
					<form action="Main.php" method="post" id="formStatusComment|-$boardComment->getId()-|">
						<select name="params[status]" onChange="javascript:submitCommentsChangeFormX('formStatusComment|-$boardComment->getId()-|')" id='boardCommentsStatusSelect|-$boardComment->getId()-|'>
							<option value="1" |-if isset($status) and ($status eq 1)-|selected="selected"|-/if-|>Pendiente</option>
							<option value="2" |-if isset($status) and ($status eq 2)-|selected="selected"|-/if-|>Aprobado</option>
							<option value="3" |-if isset($status) and ($status eq 3)-|selected="selected"|-/if-|>Spam</option>
							<option value="4" |-if isset($status) and ($status eq 4)-|selected="selected"|-/if-|>Eliminado</option>
						</select>
						<input type="hidden" name="id" id="id" value="|-$boardComment->getid()-|" />
						<input type="hidden" name="do" value="boardCommentsChangeStatusX" id="do">
					</form>
				</td>
				<td nowrap>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="boardCommentsEdit" />
						<input type="hidden" name="id" value="|-$boardComment->getid()-|" />
						<input type="submit" name="submit_go_edit_boardComment" value="Editar" class="icon iconEdit" />
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($articleId)-|
							<input type="hidden" name="articleId" value="|-$articleId-|" id="articleId"/>
						|-/if-|
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="boardCommentsDoDelete" />
						<input type="hidden" name="id" value="|-$boardComment->getid()-|" />
						<input type="submit" name="submit_go_delete_boardComment" value="Borrar" onclick="return confirm('Seguro que desea eliminar el comentario?')" class="icon iconDelete" />
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
						<input type="hidden" name="do" value="boardCommentsChangeStatuses" id="boardCommentsChangeStatusX">
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
				<th colspan="9" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=boardCommentsEdit" class="addLink">Agregar Comentario</a></div></th>
			</tr>
	|-/if-|				
		</tbody>
	</table>
</div>

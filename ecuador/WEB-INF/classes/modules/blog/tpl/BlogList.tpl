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
<h2>##blog,1,Blog##</h2>
<h1>##blog,2,Lista de Entradas##</h1>
<p>##blog,3,A continuación se muestra el listado de entradas disponibles en el sistema, ud. podrá agregar nuevas o eliminar las existente, así como publicar o archivar una entrada.##</p>
<div id="blogFilters">
<form action="Main.php" method="get">
	<fieldset title="##blog,7,Formulario de Opciones de búsqueda de entradas##">
		<legend>##blog,4,Opciones de Búsqueda##</legend>
		<p>
			<label for="fromDate">##blog,5,Fecha Desde##</label>
			<input name="filters[dateRange][creationdate][min]" type="text" id="filters_dateRange_min" class="datepickerFrom" title="fromDate" value="|-$filters.fromDate|date_format:"%d-%m-%Y"-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0"  title="Seleccione la fecha">
		</p>
		<p>
			<label for="toDate">##blog,6,Fecha Hasta##</label>
			<input name="filters[dateRange][creationdate][max]" type="text" id="filters_dateRange_max" class="datepickerTo" title="toDate" value="|-$filters.toDate|date_format:"%d-%m-%Y"-|" size="12" /> 
			<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha">
		</p>
|-if $blogConfig.useCategories.value eq "YES"-|		<p>
			<label for="categoryId">##blog,14,Categoría##</label>
			<select name='filters[categoryid]'>
					<option value=''>##blog,18,Seleccione una categoría##</option>
				|-foreach from=$categories item=category name=from_categories-|
					<option value="|-$category->getId()-|" |-if $filters neq '' and $filters.categoryid eq $category->getId()-|selected="selected"|-/if-|>|-$category->getName()-|</option>
				|-/foreach-|
			</select>
		</p>|-/if-|
		<p>
			<input type="hidden" name="do" value="blogList" />
			<input type="submit" value="##blog,8,Buscar##">
		</p>
	</fieldset>
</form>
</div>
<div id="divMsgBox"></div>
	|-if $message eq "ok"-|
		<div class="successMessage">##blog,19,Entrada guardada correctamente##</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##blog,20,Entrada eliminada correctamente##</div>
	|-elseif $message eq "changed"-|
	<div class="successMessage">##blog,21,Estados modificados correctamente##</div>
	|-elseif $message eq "not_edited"-|
	<div class="errorMessage">##blog,22,Error al modificar la entrada. Verifique que la entrada que está intentando editar existe##</div>
	|-/if-|
	|-if $notValidId-|
	<div class="errorMessage">|-$message-|</div>
	|-/if-|
|-assign var="colSpan" value=5-|
|-if $blogConfig.useCategories.value eq "YES"-||-assign var="colSpan" value=$colSpan+1-||-/if-|
<div id="div_blogEntries">
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-blogEntries">
		<thead>
			<tr>
				<th colspan="|-$colSpan-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=blogEdit" class="addLink">##blog,9,Agregar Entrada##</a></div></th>
			</tr>
			<tr>
				<th width="2%"><input type="checkbox" name="allbox" value="checkbox" id="allBoxes" onChange="javascript:selectAllCheckboxes()" title="Seleccionar todos" />
				</th>
				<th width="40%">##blog,10,Título##</th>
				<th width="8%">##blog,11,Fecha##</th>
|-if $blogConfig.useCategories.value eq "YES"-|<th width="12%">##blog,14,Categoría##</th>|-/if-|
				<th width="15%">##blog,13,Estado##</th>
				<th width="2%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$blogEntryColl item=blogEntry name=for_blogEntries-|
			<tr>
				<td><input type="checkbox" name="selected[]" value="|-$blogEntry->getId()-|"></td>
				<td>|-$blogEntry->gettitle()-|</td>
				<td>|-$blogEntry->getcreationDate()|date_format:"%d-%m-%Y"-|</td>
				|-if $blogConfig.useCategories.value eq "YES"-|<td>
					|-assign var=category value=$blogEntry->getBlogCategory()-|
					|-if empty($category)-|N/A|-else-||-$category->getName()-||-/if-|
				</td>
				|-/if-|
			<td>|-if "blogChangeStatusX"|security_user_has_access-|	
						<form action="Main.php" method="post" id="formStatusEntries|-$blogEntry->getId()-|">
							<select name="params[status]" id="selectEntryStatus|-$blogEntry->getId()-|" onChange="javascript:submitEntriesChangeFormX('formStatusEntries|-$blogEntry->getId()-|')">
								|-foreach from=$blogEntryStatus key=key item=name-|
									<option value="|-$key-|" |-if ($blogEntry->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
								|-/foreach-|
							</select>											
							<input type="hidden" name="id" id="id" value="|-$blogEntry->getid()-|" />
							<input type="hidden" name="do" value="blogChangeStatusX" id="do">
						</form>
				|-else-|
					|-assign var=articleStatus value=$blogEntry->getStatus()-|
					|-$blogEntryStatus[$articleStatus]-|
				|-/if-|
				</td>								
				<td nowrap>|-if "blogChangeStatusX"|security_user_has_access || "blogChangeStatuses"|security_user_has_access || $articleStatus eq 1-|
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="blogEdit" />
						<input type="hidden" name="id" value="|-$blogEntry->getid()-|" />
						<input type="submit" name="submit_go_edit_blogEntry" value="##common,1,Editar##" title="##common,1,Editar##" class="buttonImageEdit" />
					</form>
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="blogDoDelete" />
						<input type="hidden" name="id" value="|-$blogEntry->getid()-|" />
						<input type="submit" name="submit_go_delete_blogEntry" value="##common,2,Eliminar##" title="##common,2,Eliminar##" onclick="return confirm('##blog,22,Seguro que desea eliminar la entrada?##')" class="buttonImageDelete" />
					</form>
					|-else-|
					
					|-/if-|
				</td>
			</tr>
		|-/foreach-|
		|-if $blogEntryColl|@count neq 0 && "blogChangeStatuses"|security_user_has_access-|
			<tr>
				<td colspan="|-$colSpan-|">
					<form action="Main.php" method="post" id='multipleEntriesChangeForm'>
						<p>##blog,16,Cambiar las entradas seleccionados al estado##
							<select name="status" id="selectEntryStatus|-$blogEntry->getId()-|">
							|-foreach from=$blogEntryStatus key=key item=name-|
								<option value="|-$key-|" |-if ($blogEntry->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
							|-/foreach-|
							</select>
							|-if isset($pager)-|
								<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
							|-/if-|
							<input type="hidden" name="do" value="blogChangeStatuses" id="do">
							<input type="button" onClick="javascript:submitMultipleEntriesChangeFormX('multipleEntriesChangeForm')" value="##blog,17,Cambiar Estado##" title="##blog,17,Cambiar Estado##" class="button">
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
				<th colspan="|-$colSpan-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=blogEdit" class="addLink">##blog,9,Agregar Entrada##</a></div></th>
			</tr>
		</tbody>
	</table>
</div>

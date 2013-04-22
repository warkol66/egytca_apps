<script type="text/javascript" src="scripts/news.js">
</script>
<h2>Calendario</h2>
<h1>Lista de Eventos</h1>
<p>A continuación se muestra el listado de eventos disponibles en el sistema, ud. podrá agregar nuevos eventos o eliminar los existentes, así como publicar o archivar evento.</p>
<div id="divMsgBox"></div>
|-if $calendarEventsConfig.useCategories.value eq "YES"-|
<div id="calendarEventFilters">
<form action="Main.php" method="get">
	<fieldset>
		<legend>Opciones de Búsqueda</legend>
		<p>
			<label for="categoryId">Categoría</label>
			<select name='filters[categoryId]'>
					<option value=''>Seleccione una categoría</option>
				|-foreach from=$categories item=category name=from_categories-|
					<option value="|-$category->getId()-|" |-if $filters neq '' and $filters.categoryId eq $category->getId()-|selected="selected"|-/if-|>|-$category->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<input type="hidden" name="do" value="calendarList" />
			<input type="submit" value="Buscar">
		</p>
	</fieldset>
</form>
</div>
|-/if-|
	<div id="div_calendarEvent">
	|-if $message eq "ok"-|
		<div class="successMessage">Evento guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Evento eliminado correctamente</div>
	|-elseif $message eq "changed"-|
	<div class="successMessage">Estados modificados correctamente</div>
	|-/if-|

|-assign var="colSpan" value=6-|
|-if $calendarEventsConfig.useRegions.value eq "YES"-||-assign var="colSpan" value=$colSpan+1-||-/if-|
|-if $calendarEventsConfig.useCategories.value eq "YES"-||-assign var="colSpan" value=$colSpan+1-||-/if-|
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsarticles">
		<thead>
			<tr>
				<th colspan="|-$colSpan-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarEdit" class="addLink">Agregar Evento</a></div></th>
			</tr>
			<tr>
				<th width="2%"></th>
				<th width="40%">Título</th>
				<th width="8%">Fecha</th>
|-if $calendarEventsConfig.useRegions.value eq "YES"-|<th width="12%">Provincia</th>|-/if-|
|-if $calendarEventsConfig.useRegions.value eq "YES"-|<th width="12%">Categoría</th>|-/if-|
<!--								<th>Usuario</th> -->
				<th width="15%">Estado</th>
				<th width="2%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$calendarEventColl item=calendarEvent name=for_calendaEvents-|
			<tr>
				<td><input type="checkbox" name="selected[]" value="|-$calendarEvent->getId()-|"></td>
				<td>|-$calendarEvent->gettitle()-|</td>
				<td>|-$calendarEvent->getstartDate()|date_format:"%d-%m-%Y"-|</td>
<!--|-if $calendarEventsConfig.useRegions.value eq "YES"-|<td>
					|-assign var=region value=$calendarEvent->getRegion()-|
					|-if empty($region)-|N/A|-else-||-$region->getName()-||-/if-|
				</td>|-/if-|-->
|-if $calendarEventsConfig.useCategories.value eq "YES"-|<td>
					|-assign var=category value=$calendarEvent->getCategory()-|
					|-if empty($category)-|N/A|-else-||-$category->getName()-||-/if-|
				</td>|-/if-|
<!--								<td>|-$calendarEvent->getuserId()-|</td> -->
				<td>|-if "calendarEventsChangeStatusX"|security_user_has_access-|	
						<form action="Main.php" method="post" id="formStatuscalendarEvent|-$calendarEvent->getId()-|">
							<select name="params[status]" id="selectStatusEvent|-$calendarEvent->getId()-|" onChange="javascript:submitEventsChangeFormX('formStatuscalendarEvent|-$calendarEvent->getId()-|')">
								|-foreach from=$calendarEventStatus key=key item=name-|
									<option value="|-$key-|" |-if ($calendarEvent->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
								|-/foreach-|
							</select>											
							<input type="hidden" name="id" id="id" value="|-$calendarEvent->getid()-|" />
							<input type="hidden" name="do" value="calendarChangeStatusX" id="do">
						</form>
				|-else-|
					|-assign var=calendarStatus value=$calendarEvent->getStatus()-|
					|-$calendarEventStatus[$calendarStatus]-|
				|-/if-|
				</td>								
				<td nowrap>|-if "calendarEventsChangeStatusX"|security_user_has_access || "calendarEventsChangeStatuses"|security_user_has_access || $calendarStatus eq 1-|
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="calendarEdit" />
						<input type="hidden" name="id" value="|-$calendarEvent->getid()-|" />
						<input type="submit" name="submit_go_edit_calendarEvent" value="Editar" class="buttonImageEdit" />
					</form>
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="calendarDoDelete" />
						<input type="hidden" name="id" value="|-$calendarEvent->getid()-|" />
						<input type="submit" name="submit_go_delete_calendarEvent" value="Borrar" onclick="return confirm('Seguro que desea eliminar el evento?')" class="buttonImageDelete" />
					</form>
					|-else-|
					
					|-/if-|
				</td>
			</tr>
		|-/foreach-|
		|-if $calendarEvents|@count neq 0 && "calendarEventsChangeStatuses"|security_user_has_access-|
			<tr>
				<td colspan="|-$colSpan-|">
					<p><input type="button" name="selectAll" value="Seleccionar Todos" id="selectAll" onClick="javascript:selectAllCheckboxes()" class="smallButton" /></p>
					<form action="Main.php" method="post" id='multipleEventsChangeForm'>
						<p>Cambiar los Artículos seleccionados al estado 
							<select name="status" id="selectStatusEvent|-$calendarEvent->getId()-|">
							|-foreach from=$calendarEventStatus key=key item=name-|
								<option value="|-$key-|" |-if ($calendarEvent->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
							|-/foreach-|
							</select>
							|-if isset($pager)-|
								<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
							|-/if-|
							<input type="hidden" name="do" value="calendarChangeStatuses" id="do">
							<input type="button" onClick="javascript:submitMultipleEventsChangeFormX('multipleEventsChangeForm')" value="Cambiar Estado" class="smallButton">
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
				<th colspan="|-$colSpan-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarEdit" class="addLink">Agregar Evento</a></div></th>
			</tr>
		</tbody>
	</table>
</div>

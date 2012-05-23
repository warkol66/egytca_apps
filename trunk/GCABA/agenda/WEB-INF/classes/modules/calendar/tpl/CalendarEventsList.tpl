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
			<label for="categoryId">Dependencia</label>
			<select name='filters[categoryId]'>
					<option value=''>Seleccione una dependencia</option>
				|-foreach from=$categories item=category name=from_categories-|
					<option value="|-$category->getId()-|" |-if $filters neq '' and $filters.categoryId eq $category->getId()-|selected="selected"|-/if-|>|-$category->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<input type="hidden" name="do" value="calendarEventsList" />
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

|-assign var="colSpan" value=5-|
|-if $calendarEventsConfig.useRegions.value eq "YES"-||-assign var="colSpan" value=$colSpan+1-||-/if-|
|-if $calendarEventsConfig.useCategories.value eq "YES"-||-assign var="colSpan" value=$colSpan+1-||-/if-|
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsarticles">
		<thead>
			<tr>
				<th colspan="|-$colSpan-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarEventsEdit" class="addLink">Agregar Evento</a></div></th>
			</tr>
			<tr>
				<th width="40%">Título</th>
				<th width="8%">Fecha</th>
<!--								<th>Usuario</th> -->
				<th width="15%">Estado</th>
				<th width="2%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$calendarEvents item=calendarEvent name=for_calendaEvents-|
			<tr>
				<td>|-$calendarEvent->gettitle()-|</td>
				<td>|-$calendarEvent->getstartDate()|dateTime_format-|</td>
<!--								<td>|-$calendarEvent->getuserId()-|</td> -->
				<td>|-if "calendarEventsChangeStatusX"|security_user_has_access-|	
						<form action="Main.php" method="post" id="formStatuscalendarEvent|-$calendarEvent->getId()-|">
							<select name="calendarEvent[status]" id="selectStatusEvent|-$calendarEvent->getId()-|" onChange="javascript:submitEventsChangeFormX('formStatuscalendarEvent|-$calendarEvent->getId()-|')">
								|-foreach from=$eventStatuses key=key item=name-|
									<option value="|-$key-|" |-if ($calendarEvent->getStatus()) eq $key-|selected="selected"|-/if-|>|-$name-|</option>
								|-/foreach-|
							</select>											
							<input type="hidden" name="calendarEvent[id]" id="calendarEvent_id" value="|-$calendarEvent->getid()-|" />
							<input type="hidden" name="do" value="calendarEventsChangeStatusX" id="do">
						</form>
				|-else-|
					|-$eventStatuses[$calendarEvent->getStatus()]-|
				|-/if-|
				</td>								
				<td nowrap>|-if "calendarEventsChangeStatusX"|security_user_has_access || "calendarEventsChangeStatuses"|security_user_has_access || $calendarStatus eq 1-|
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="calendarEventsEdit" />
						<input type="hidden" name="id" value="|-$calendarEvent->getid()-|" />
						<input type="submit" name="submit_go_edit_calendarEvent" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="calendarEventsDoDelete" />
						<input type="hidden" name="id" value="|-$calendarEvent->getid()-|" />
						<input type="submit" name="submit_go_delete_calendarEvent" value="Borrar" onclick="return confirm('Seguro que desea eliminar el calendarEvent?')" class="icon iconDelete" />
					</form>
					|-else-|
					
					|-/if-|
				</td>
			</tr>
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="|-$colSpan-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				<th colspan="|-$colSpan-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarEventsEdit" class="addLink">Agregar Evento</a></div></th>
			</tr>
		</tbody>
	</table>
</div>

<h2>Calendario</h2>
<h1>Lista de Eventos de Contexto</h1>
<p>A continuación se muestra el listado de eventos de contexto disponibles en el sistema, ud. podrá agregar nuevos o eliminar los existentes, así como publicar o archivar evento.</p>
<div id="divMsgBox"></div>
	<div id="div_calendarEvent">
	|-if $message eq "ok"-|
		<div class="successMessage">Evento guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Evento eliminado correctamente</div>
	|-elseif $message eq "changed"-|
	<div class="successMessage">Estados modificados correctamente</div>
	|-/if-|

	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsarticles">
		<thead>
		<tr>
			<td colspan="4" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda de Eventos de Contexto</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get' style="display:inline;">
				<p>
					<label for="filters[searchString]">Nombre</label>
					<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="25" title="Ingrese el nombre a buscar" />
				</p>
				<p>
					<input type="submit" value="Buscar" title="Buscar con los par&aacute;metros ingresados" />
					<input type="hidden" name="do" value="calendarContextEventsList" />
					&nbsp;&nbsp;
					|-if $filters|@count gt 0-|
						<input type="button" value="Quitar Filtros" onclick="location.href='Main.php?do=calendarContextEventsList'"/>
					|-/if-|
				</p>
				</form>
				</div>
			</td>
		</tr>	
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarContextEventsEdit" class="addLink">Agregar Evento de Contexto</a></div></th>
			</tr>
			<tr>
				<th width="40%">Título</th>
				<th width="8%">Fecha</th>
				<th width="15%">&nbsp;</th>
				<th width="2%">Tipo</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$events item=calendarEvent name=for_calendaEvents-|
			<tr>
				<td>|-$calendarEvent->gettitle()-|</td>
				<td>|-$calendarEvent->getstartDate()|date_format-|</td>
				<td>|-$calendarEvent->getContextTypeName()-|</td>								
				<td nowrap>|-if "calendarContextEventsEdit"|security_user_has_access-|
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="calendarContextEventsEdit" />
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
					|-/if-|
				</td>
			</tr>
		|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarContextEventsEdit" class="addLink">Agregar Evento de Contexto</a></div></th>
			</tr>
		</tbody>
	</table>
</div>

<h2>Calendario</h2>
<h1>Lista de Feriados</h1>
<p>A continuación se muestra el listado de feriados y Efemérides disponibles en el sistema, ud. podrá agregar nuevos o editar los existentes.</p>
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
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarHolidayEventsEdit" class="addLink">Agregar Feriado</a></div></th>
			</tr>
			<tr>
				<th width="40%">Título</th>
				<th width="8%">Fecha</th>
				<th width="2%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$events item=calendarEvent name=for_calendaEvents-|
			<tr>
				<td>|-$calendarEvent->getTitle()-|</td>
				<td>|-$calendarEvent->getstartDate()|date_format-|</td>
				<td nowrap>|-if "calendarHolidayEventsEdit"|security_user_has_access-|
					<form action="Main.php" method="get">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="calendarHolidayEventsEdit" />
						<input type="hidden" name="id" value="|-$calendarEvent->getid()-|" />
						<input type="submit" name="submit_go_edit_calendarEvent" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<!--pasaje de parametros de filtros -->
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						<input type="hidden" name="do" value="calendarHolidayEventsDoDelete" />
						<input type="hidden" name="id" value="|-$calendarEvent->getid()-|" />
						<input type="submit" name="submit_go_delete_calendarEvent" value="Borrar" onclick="return confirm('Seguro que desea eliminar el calendarEvent?')" class="icon iconDelete" />
					</form>
					|-/if-|
				</td>
			</tr>
		|-/foreach-|
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="3" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarHolidayEventsEdit" class="addLink">Agregar Feriado</a></div></th>
			</tr>
		</tbody>
	</table>
</div>

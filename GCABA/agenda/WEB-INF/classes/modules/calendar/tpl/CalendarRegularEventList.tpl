<h2>Efemérides</h2>
<h1>Administración de Efemérides</h1>
<p>A continuación se muestra la lista de Efemérides cargadas en el sistema.</p>
<div id="div_entities"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Efeméride guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Efeméride eliminada correctamente</div>
	|-/if-|
	<table id="table_entities" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="4" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda de Efemérides</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
				<form action='Main.php' method='get' style="display:inline;">
				<p>
					<label for="filters[searchString]">Nombre</label>
					<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="25" title="Ingrese el nombre a buscar" />
				</p>
				<p>
					<input type="submit" value="Buscar" title="Buscar con los par&aacute;metros ingresados" />
					<input type="hidden" name="do" value="calendarRegularEventList" />
					&nbsp;&nbsp;
					|-if $filters|@count gt 0-|
						<input type="button" value="Quitar Filtros" onclick="location.href='Main.php?do=calendarRegularEventList'"/>
					|-/if-|
				</p>
				</form>
				</div>
			</td>
		</tr>
		
		|-if "calendarRegularEventList"|security_has_access-|
		<tr>
			<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarRegularEventEdit" class="addLink">Agregar Efeméride</a></div></th>
		</tr>
		|-/if-|
		<tr class="thFillTitle">
			<th width="50%">Nombre</th>
			<th width="35%">Fecha</th>
			<th nowrap width="10%">Crear en |-$holidayCreationYear-|</th>
			<th width="5%">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		|-if $entities|@count eq 0-|
		<tr>
			<td colspan="4">|-if isset($filters)-|No hay Efemérides que concuerden con la búsqueda|-else-|No hay Efemérides disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$entities item=entity name=for_entities-|
		<tr> 
			<td>|-$entity->getName()-|</td>
			<td>|-$entity->getDate()|date_format:"%d - %m"-|</td>
			<td nowrap align="center">
				|-if "calendarHolidayEventEdit"|security_has_access && !$entity->isInstantiated($holidayCreationYear)-|
					<input id="createHolidayButton_|-$entity->getId()-|_|-$holidayCreationYear-|" type="button" title="Crear Evento" class="icon iconAdd" onclick="createHolidayFromRegEvent('|-$entity->getId()-|', '|-$holidayCreationYear-|');" />
				|-/if-|
			</td>
			<td nowrap>
				|-if "calendarRegularEventEdit"|security_has_access-|
				<form action="Main.php" method="get">
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
						<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="do" value="calendarRegularEventEdit" />
					<input type="hidden" name="id" value="|-$entity->getId()-|" />
					<input type="submit" value="Editar" title="Editar" class="icon iconEdit" />
				</form>
				|-/if-|
				|-if "calendarRegularEventDoDelete"|security_has_access-|
				<form action="Main.php" method="post">
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() gt 1)-|
					<input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />
					|-/if-|
					<input type="hidden" name="do" value="calendarRegularEventDoDelete" />
					<input type="hidden" name="id" value="|-$entity->getid()-|" />
					<input type="submit" value="Borrar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar la Efeméride?')" class="icon iconDelete" />
				</form>
				|-/if-|
			</td>
		</tr> 
		|-/foreach-|
		|-/if-|
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
		|-if "calendarRegularEventEdit"|security_has_access-|
		<tr>
			<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarRegularEventEdit" class="addLink">Agregar Efeméride</a></div></th>
		</tr>
		|-/if-|
		</tbody>
	</table>
</div>

<script type="text/javascript">
	createHolidayFromRegEvent = function(regEventId, year) {
		$.ajax({
			url: 'Main.php?do=calendarHolidayEventCreateFromRegularEventX',
			type: 'post',
			data: { regularEventId: regEventId, year: year },
			dataType: 'json',
			success: function(event) {
				$('#createHolidayButton_'+regEventId+'_'+year).remove();
			}
		});
	}
</script>
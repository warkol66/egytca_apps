<h2>Tablero de Gestión</h2>
<h1>Administración de Suscripción a Agendas.</h1>
<p>A continuación se muestra la lista de Suscripciones a Agendas cargados en el sistema.</p>
<div id="div_schedulesSubscriptions"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Suscripción a Agenda guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Suscripción a Agenda eliminado correctamente</div>
	|-/if-|
	<table id="tabla-schedulesSubscriptions" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="7" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de suscripciones a agendas</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="commonSchedulesSubscriptionsList" />
					Texto a buscar: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />

					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>
					|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="commonSchedulesSubscriptionsList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=commonSchedulesSubscriptionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Suscripción a Agenda</a></div></th>
			</tr>
			<tr class="thFillTitle"> 
				<th width="55%">Nombre</th> 
				<th width="40%">Nombre de entidad</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $schedulesSubscriptions|@count eq 0-|
		<tr>
			 <td colspan="7">|-if isset($filter)-|No hay suscripciones a agendas que concuerden con la búsqueda|-else-|No hay suscripciones a agendas disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$schedulesSubscriptions item=scheduleSubscription name=for_schedulesSubscriptions-|
		<tr> 
			<td>|-$scheduleSubscription->getName()-|</td> 
			<td>|-assign var=moduleEntity value=$scheduleSubscription->getModuleEntity()-||-$moduleEntity->getPhpName()-|</td>
			<td nowrap> 
				<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="commonSchedulesSubscriptionsEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$scheduleSubscription->getid()-|" /> 
					<input type="submit" name="submit_go_edit_scheduleSubscription" value="Editar" class="icon iconEdit" /> 
				</form>
				|-if $loginUser ne '' && ($loginUser->isAdmin() || $loginUser->isSupervisor())-|
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="commonSchedulesSubscriptionsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$scheduleSubscription->getid()-|" /> 
					<input type="submit" name="submit_go_delete_scheduleSubscription" value="Borrar" onclick="return confirm('Seguro que desea eliminar este acto?')" class="icon iconDelete" /> 
				</form>
				|-/if-|
			</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="7" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="7" class="thFillTitle">|-if $schedulesSubscriptions|@count gt 5-|<div class="rightLink"><a href="Main.php?do=commonSchedulesSubscriptionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Suscripción a Agenda</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>

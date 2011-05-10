<h2>Tablero de Gestión</h2>
<h1>Administración de Suscripción a Alertas.</h1>
<p>A continuación se muestra la lista de Suscripciones a Alertas cargados en el sistema.</p>
<div id="div_alertsSubscriptions"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Suscripción a Alerta guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Suscripción a Alerta eliminado correctamente</div>
	|-/if-|
	<table id="tabla-alertsSubscriptions" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="7" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda de suscripciones a alertas</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="commonAlertsSubscriptionsList" />
					Texto a buscar: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />

					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>
					|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="commonAlertsSubscriptionsList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=commonAlertsSubscriptionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Suscripción a Alerta</a></div></th>
			</tr>
			<tr class="thFillTitle"> 
				<th width="55%">Nombre</th> 
				<th width="40%">Nombre de entidad</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $alertsSubscriptions|@count eq 0-|
		<tr>
			 <td colspan="7">|-if isset($filter)-|No hay suscripciones a alertas que concuerden con la búsqueda|-else-|No hay suscripciones a alertas disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$alertsSubscriptions item=alertSubscription name=for_alertsSubscriptions-|
		<tr> 
			<td>|-$alertSubscription->getName()-|</td> 
			<td>|-assign var=moduleEntity value=$alertSubscription->getModuleEntity()-||-$moduleEntity->getPhpName()-|</td>
			<td nowrap> 
				<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="commonAlertsSubscriptionsEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$alertSubscription->getid()-|" /> 
					<input type="submit" name="submit_go_edit_alertSubscription" value="Editar" class="iconEdit" /> 
				</form>
				|-if $loginUser ne '' && ($loginUser->isAdmin() || $loginUser->isSupervisor())-|
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="commonAlertsSubscriptionsDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$alertSubscription->getid()-|" /> 
					<input type="submit" name="submit_go_delete_alertSubscription" value="Borrar" onclick="return confirm('Seguro que desea eliminar este acto?')" class="iconDelete" /> 
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
				 <th colspan="7" class="thFillTitle">|-if $alertsSubscriptions|@count gt 5-|<div class="rightLink"><a href="Main.php?do=commonAlertsSubscriptionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar Suscripción a Alerta</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>

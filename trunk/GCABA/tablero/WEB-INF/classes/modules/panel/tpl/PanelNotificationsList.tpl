|-include file="CommonAutocompleterInclude.tpl" -|

<script type="text/javascript" language="javascript" charset="utf-8">
function getMailBody(notificationId) {
	var myAjax = new Ajax.Updater(
				{success: 'lightbox_content'},
				'Main.php?do=panelNotificationsGetMailBodyX',
				{
					method: 'get',
					parameters: { notificationId: notificationId}
				});
	$('lightbox_content').innerHTML = '<span class="inProgress">Obteniendo contenido...</span>';
	return true;
}
</script>


<script type="text/javascript" src="scripts/lightbox.js"></script>
<div id="lightbox1" class="leightbox"> 
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconDelete" /></a> 
	</p> 
	<div id="lightbox_content"></div>
</div> 

<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Notificaciones
<!-- /Link VOLVER -->
</h1>

<p>A continuación podrá ver las notificaciones que fueron enviadas.</p>
<div id="div_notifications">
	|-if $message eq "resend_ok"-|
		<div class="successMessage">La notificación fue reenviada.</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders nestedTable' id="tabla-notifications">
		<thead>
		<tr>
			<td colspan="5" class="tdSearch"><div><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a></div>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
					<form action='Main.php' method='get' style="display:inline;">
						<input type="hidden" name="do" value="panelNotificationsList" />
						<p>
							Por tipo
							<select id="filters[type]" name="filters[type]" title="type">
								<option value="0">Seleccione el tipo</option>
								|-foreach from=$types key=typeKey item=type name=for_type-|
				       				<option value="|-$typeKey-|" |-if $typeKey eq $filters.type-|selected="selected" |-/if-|>|-$type-|</option> 
								|-/foreach-|
		      				</select>
	      				</p>
	      				<p>
							|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_users" label="Por usuario" url="Main.php?do=usersAutocompleteListX&adminActId=" hiddenName="filters[userId]" disableSubmit="filters_submit"-|
	      				</p>
	      				<p>
							Contenido: 
							<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
							&nbsp;&nbsp;
						</p>
						<input id="filters_submit" type='submit' value='Buscar' class='tdSearchButton' />
					</form>
					|-if $filters|@count gt 0-|
					<form  method="get">
						<input type="hidden" name="do" value="panelNotificationsList" />
						<input type="submit" value="Quitar Filtros" />
					</form>|-/if-|
				</div>
			</td>
		</tr>
			<tr>
				 <th colspan="5" class="thFillTitle">
				</th>
			</tr>
			<tr class="thFillTitle">
				<th width="55%">Destinatario</th>
				<th width="40%">Fecha de envío</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $notifications|@count eq 0-|
			<tr>
				 <td colspan="5">|-if isset($filters)-|No hay notificaciones que concuerden con la búsqueda|-else-|No hay notificaciones disponibles|-/if-|</td>
			</tr>
		|-else-|
			|-foreach from=$notifications item=notification name=for_notifications-|
				<tr>
					|-assign var=user value=$notification->getUser()-|
					<td>|-if ($user->getName() ne '') or ($user->getSurname() ne '')-||-$user->getSurname()-|, |-$user->getName()-| - |-/if-|(|-$user->getUserName()-|)</td>
					<td>|-$notification->getDeliveredOn()-|</td>
					<td nowrap>
						<a href="#lightbox1" rel="lightbox1" class="lbOn" alt="Ver" title="Ver" onMouseDown="getMailBody(|-$notification->getId()-|);"><img src="images/clear.png" class="linkImageView"></a>
						<form action="Main.php" method="post" style="display:inline;">
							|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
							|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
							<input type="hidden" name="do" value="panelNotificationsResend" />
							<input type="hidden" name="id" value="|-$notification->getid()-|" />
							<input type="submit" name="submit_go_resend" title="Reenviar" value="Reenviar" onclick="return confirm('¿Seguro que desea reenviar esta notifiación?')" class="icon iconSendMultiple" />
						</form>
					</td>
				</tr>
			|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|7|-else-|6|-/if-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>
		|-/if-|
			<tr>
				 <th colspan="5" class="thFillTitle"></th>
			</tr>
		|-/if-|
		</tbody>
	</table>
</div>


<ul>
</ul>


<script type="text/javascript" language="javascript" charset="utf-8">
	jQuery.noConflict();
</script>
<script src="scripts/functions.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/prototype.js" language="JavaScript" type="text/javascript"></script>
<script src="scripts/lightbox.js" language="JavaScript" type="text/javascript"></script>
|-if !$result-|
<h2>Mensajería Interna</h2>
<h1>Administración de Mensajes</h1>
<p>A continuación se muestra la lista de mensajes.</p>
	|-if $message eq "ok"-|
		<div class="successMessage">Mensaje enviado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Mensaje eliminado correctamente</div>
	|-/if-|
|-else-|
<h3>Mensajería Interna</h3>
|-/if-|
<div id="div_internalMails"> 
	<table id="tabla-internalMails" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
			<tr>
				<td colspan="5" class="tdSearch"><div class="rightLink"><a href="javascript:void(null);" onClick="$('divSearch').toggle();" class="tdTitSearch">Filtros de búsqueda</a></div>
					<div id="divSearch" style="display:none;">
						<form action='Main.php' method='get' style="display:inline;">
							<input type="hidden" name="do" value="commonInternalMailsList" />
							<p>
								<label for="filters[searchSentOnly]" >Enviados</label>
								<input class="filter" type="checkbox" name="filters[searchSentOnly]" value="true" |-if isset($filters.searchSentOnly)-|checked |-/if-|/>
								<br /><br />
								<label for="filters[searchUnreadOnly]" >No leidos</label>
								<input class="filter" type="checkbox" name="filters[searchUnreadOnly]" value="true" |-if isset($filters.searchUnreadOnly)-|checked |-/if-|/>
							</p>
							<p>
								<label for="filters[searchString]" >Texto a buscar: </label>
								<input class="filter" name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" title="Ingrese el texto a buscar" />
							</p>
							<p>
								<input type="submit" value="Buscar" />
							|-if $filters|@count gt 0-|
							<input type="button" value="Quitar Filtros" onClick="location.href='Main.php?do=commonInternalMailsList'" />
							|-/if-|
							</p>
						</form>
					</div>
				</td>
			</tr>
			<tr>
				<th colspan="5">
						<a href="Main.php?do=commonInternalMailsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="linkMailNew">Nuevo mensaje</a>
					<div class="rightLink">
						<a href="#" class="linkMailDelete" onClick="javascript:deleteMessages();return false;">Eliminar</a>
					</div>
					<div class="rightLink">
						<a href="#" class="linkMailMarkRead" onClick="javascript:markAsRead();return false;">Marcar como leido</a>
					</div>
					<div class="rightLink">
						<a href="#" class="linkMailMarkUnread" onClick="javascript:markAsUnread();return false;">Marcar como no leido</a>
					</div>
				</th>
			</tr>
			<tr> 
				<th width="5%">&nbsp;</th> 
				<th width="5%"><input id="allbox" onclick="javascript:checkBoxesByName('selectedIds[]')" type="checkbox"></th> 
				<th width="20%">Remitente</th> 
				<th width="10%">Fecha</th> 
				<th width="60%">Asunto</th> 
			</tr> 
		</thead> 
		<tbody id="internalMailsList">
		|-if !$result-|
			|-include file="CommonInternalMailsListTableBodyInclude.tpl"-|
		|-else-|
			|-include file="CommonInternalMailsListTableBodyInclude.tpl" internalMails=$result.messages pager=$result.pager url="Main.php?do=commonInternalMailsList"-|
		|-/if-|
		</tbody> 
	</table> 
</div>

<div id="lightbox1" class="leightbox"> 
	<div align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</div> 
	<div id="lightboxContent">
	</div>
</div> 

<!--div style="display:none;">
	<div id="data">
	</div>
</div-->

<script type="text/javascript" language="javascript" charset="utf-8">

	var selected=-1;
	
	function deleteMessages(ids) {
		if (ids === undefined)
			ids = Form.serializeElements($$('.selector'));
		else
			ids = Object.toQueryString(ids);
		var fields = ids + '&' + Form.serializeElements($$('.filter')) + '&' + Form.serializeElements($$('#page'));
		var myAjax = new Ajax.Updater(
			{success: 'internalMailsList'},
			'Main.php?do=commonInternalMailsDoDeleteX',
			{
				method: 'post',
				postBody: fields,
				evalScripts: true,
				onComplete: updateLightBox //inicializamos el lighbox nuevamente
			}
		);
		return true;
	}
	
	function markAsRead(ids) {
		if (ids === undefined)
			ids = jQuery('.selector').serialize();
		else
			ids = 'selectedIds[]=' + ids;//Object.toQueryString(ids);
		var fields = ids + '&' + jQuery('.filter').serialize() + '&' + jQuery('#page').serialize();
		jQuery.ajax({
			url: 'Main.php?do=commonInternalMailsDoMarkAsReadX',
			data: fields,
			type: 'post',
			success: function(data){
				jQuery('#internalMailsList').html(data);
				updateLightBox();
			}	
		});
		jQuery('#allbox').attr('checked',false);
		return true;
	}
	
	function markAsUnread(ids) {
		if (ids === undefined)
			ids = jQuery('.selector').serialize();
		else
			ids = 'selectedIds[]=' + ids;//Object.toQueryString(ids);
		var fields = ids + '&' + jQuery('.filter').serialize() + '&' + jQuery('#page').serialize() + 'reverse=true';
		jQuery.ajax({
			url: 'Main.php?do=commonInternalMailsDoMarkAsReadX',
			data: fields,
			type: 'post',
			success: function(data){
				jQuery('#internalMailsList').html(data);
				updateLightBox();
			}	
		});
		jQuery('#allbox').attr('checked',false);
		return true;
	}
	
	function view(id) {
		//Marcamos como leido el mensaje
		var fields = 'selectedIds[]=' + id + '&' + Form.serializeElements($$('.filter')) + '&' + Form.serializeElements($$('#page'));
		var myAjax = new Ajax.Updater(
			{success: 'internalMailsList'},
			'Main.php?do=commonInternalMailsDoMarkAsReadX',
			{
				method: 'post',
				postBody: fields,
				evalScripts: true,
				onComplete: updateLightBox //inicializamos el lighbox nuevamente
			}
		);
		if (selected != id) { 
			
			/*jQuery.ajax({
				url: 'Main.php?do=commonInternalMailsViewX&id='+id,
				type: 'post',
				success: function(data){
					jQuery('#data').html(data);
					
				}
			});
			jQuery('a#inline'+id).fancybox();*/
			//Cargamos los datos en el lightbox.
			document.getElementById('lightboxContent').innerHTML = "<p class='inProgress'>Cargando mensaje</p>";
			var myAjax = new Ajax.Updater(
				{success: 'lightboxContent'},
				'Main.php?do=commonInternalMailsViewX&id='+id,
				{
					method: 'post',
					evalScripts: true,
					onComplete: updateLightBox //inicializamos el lighbox nuevamente
				}
			);
			selected = id;
		}
		
		return true;
	}
	
	function updateLightBox() {
		/*lbox = $('.lbOn');
		for(i = 0; i < lbox.length; i++) {
			valid = $(lbox[i]).lightbox;
			lbActions = $('.lbAction');
			for(j = 0; j < lbActions.length; j++) {
				$(lbActions[j]).click(function(){
					valid[lbActions[j].rel].bind(valid);
					return false;
				});
			}
		}*/
		lbox = document.getElementsByClassName('lbOn');
		for(i = 0; i < lbox.length; i++) {
			valid = new lightbox(lbox[i]);
			lbActions = document.getElementsByClassName('lbAction');
			for(j = 0; j < lbActions.length; j++) {
				Event.observe(lbActions[j], 'click', valid[lbActions[j].rel].bindAsEventListener(valid), false);
				lbActions[j].onclick = function(){return false;};
			}
		}
	}
	
</script>

<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<style>
/*debemos sobreescribir esta regla para permitir que el lighbox */
/*se dispare sobre toda la superficie de la celda */
table#tabla-internalMails td {
	padding: 0;
}

div.cellContent {
	padding: 4px;
	cursor: pointer;
}
</style>

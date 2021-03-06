<script type="text/javascript" src="scripts/jquery/egytca.js"></script>

<script type="text/javascript">
$(function(){
	var actions = [|-foreach from=$actions item=avAction name=actions-|"|-$avAction->getAction()-|"|-if !$smarty.foreach.users.last-|,|-/if-||-/foreach-|];
	
	$("#action").autocomplete({
		source: actions,
		change: function(event,ui){
		  $(this).val((ui.item ? ui.item.label : ""));
		}
	});
});

	function getDefaultInfo() {
		$('#indicator2').show();
		$.ajax({
			url: 'Main.php?do=commonMenuItemsGetActionInfoX',
			data: { |-if $menuItem->getId() ne ''-|menuItemId:|-$menuItem->getId()-|, |-/if-|action: $('menuItem_action').value},
			type: 'get',
			success: function(data){
				$('#lang_info').html(data);
			}	
		});
		/*var myAjax = new Ajax.Updater(
				{success: 'lang_info'},
				"Main.php?do=commonMenuItemsGetActionInfoX",
				{
					method: 'get',
					parameters: { |-if $menuItem->getId() ne ''-|menuItemId:|-$menuItem->getId()-|, |-/if-|action: $('menuItem_action').value},
					evalScripts: true
				});	*/
	}

	var paramCount = "|-$params.count-|";
	function useExternalUrlChanged() {
		$("#external_url_info").slideToggle();
		$("#action_info").slideToggle();		
	}
	
	function addParamToAction() {
		paramCount++;
		var htmlContent = '<li>Nombre del argumento: <input type="text" name="param[name][' + paramCount +']" value=""> Valor: <input type="text" name="param[value][' + paramCount + ']" value=""><a href="#" onClick="deleteParamFromAction(this); return false;" alt="Eliminar" title="Eliminar" ><img src="images/clear.png" class="icon iconDelete"></a></li>';
		//htmlContent.replace("%count%", paramCount);
		$("#params_list").append(htmlContent);	
	}

	function deleteParamFromAction(anchorElement) {
		// no importa que los indices de los parametros sean consecutivos, solo que sean distintos. 
		// Por eso no hace falta hacer nada especial con paramCount al borrar.
		$(anchorElement).parent().remove();
	}
</script>

	<h2>Módulo de Menús</h2>
	<h1>Administrar Menús</h1>
	
	<p>Ingrese la información solicitada y haga click en "Guardar"</p>
	<fieldset>
		<legend>|-if isset($create)-|Agregar |-/if-|Menú</legend>
		
		<form id="editors_here" action="Main.php?do=commonMenuItemsDoEdit" method="post">
			<input name="params[parentId]" type="hidden" id="params[parentId]" value="|-$parentId-|" />
			|-if !$menuItem->isNew()-|
			<input name="id" type="hidden" id="id" value="|-$menuItem->getId()-|" /> 
			|-/if-|
				<p>Informacion del enlace</p>
				<p><label for="useExternalUrl">URL</label>
					<input type="radio" name="useExternalUrl" |-if !$menuItem->usingExternalUrl()-|checked="true"|-/if-| value="false" onclick="useExternalUrlChanged();" /> Usar enlace interno
					<input type="radio" name="useExternalUrl" value="true" |-if $menuItem->usingExternalUrl()-|checked="true"|-/if-| onclick="useExternalUrlChanged();" /> Usar enlace externo
				</p>
				<div id="external_url_info" |-if !$menuItem->usingExternalUrl()-| style="display: none;" |-/if-|>
					<label>Url: </label>
					<input type="text" name="params[url]" id="params[url]" value="|-$menuItem->getUrl()-|" />
				</div>
				<div id="action_info" |-if $menuItem->usingExternalUrl()-| style="display: none;" |-/if-| style="position: relative;">
					<div style="float: left;">
						<label>Elija una acción</label>
						<input id="action" name="params[action]" />
					</div>
					<a href="#" onclick="addParamToAction(); return false;" alt="Agregar argumento" title="Agregar argumento"><img src="images/clear.png" class="icon iconAdd" /></a>
					<a href="#" onclick="getDefaultInfo(); return false;" alt="Obtener valores por defecto" title="Obtener valores por defecto"><img src="images/clear.png" class="icon iconEmail" /></a>
					<!-- por algun extraño motivo usar el indicator1 para indicar la demora en obtener la informacion de idioma no funciona -->
					<span id="indicator2" style="display: none">
	  					<img src="images/spinner.gif" alt="Procesando..." />
					</span>
					<div style="clear: both;"></div>
					<ul id="params_list">
					|-foreach from=$params key=key item=value name=it_params-|
						<li>Nombre del argumento: <input type="text" name="param[name][]" value="|-$key-|"> Valor: <input type="text" name="param[value][]" value="|-$value-|"><a href="#" onClick="deleteParamFromAction(this); return false;" alt="Eliminar" title="Eliminar" ><img src="images/clear.png" class="icon iconDelete"></a></li>
					|-/foreach-|
					<li>Nombre del argumento: <input type="text" name="param[name][]" value=""> Valor: <input type="text" name="param[value][]" value=""><a href="#" onClick="deleteParamFromAction(this); return false;" alt="Eliminar" title="Eliminar" >Eliminar</a></li>
					</ul>
				</div>
				<p>
					<label for="params[newWindow]">Abrir en nueva ventana</label><input type="checkbox" name="params[newWindow]" |-$menuItem->getNewWindow()|checked_bool-| /> 
				</p>
				<hr />
			<div id="lang_info">
			|-foreach from=$languages item=langItem-|
				<h3>|-$langItem->getName()|multilang_get_translation:"multilang"-|</h3>
				 	|-assign var=languageCode value=$langItem->getCode()-|
				<div id="edit_section_|-$languageCode-|">
					|-include file="CommonMenuItemsLanguageInfoInclude.tpl" menuItemInfo=$menuItem->getMenuInfo($languageCode)-|
				</div>
			|-/foreach-|
			</div> 
			<p> 
				<input type="submit" value="Guardar" /> 
			</p> 
		</form>
	
	</fieldset>
	
	|-if !$menuItem->isNew()-|
	<fieldset>
		<legend>Vista Preliminar</legend>
		|-include_module module=Common action=MenuItemsShow options="template=CommonMenuItemsHorizontalView.tpl&id="|cat:$menuItem->getId()-|
	</fieldset>
	|-/if-|

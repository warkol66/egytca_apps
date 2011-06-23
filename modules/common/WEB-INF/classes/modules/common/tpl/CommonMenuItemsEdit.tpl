|-include file="CommonAutocompleterInclude.tpl"-|
<script type="text/javascript">

	function getSelectionActionInfo(text, li) {
		$('menuItem_action').value = li.innerHTML.stripTags();	
	}

	function getDefaultInfo() {
		$('indicator2').show();
		var myAjax = new Ajax.Updater(
				{success: 'lang_info'},
				"Main.php?do=commonMenuItemsGetActionInfoX",
				{
					method: 'get',
					parameters: { |-if $menuItem->getId() ne ''-|menuItemId:|-$menuItem->getId()-|, |-/if-|action: $('menuItem_action').value},
					evalScripts: true
				});	
	}

	var paramCount = "|-$params.count-|";
	function useExternalUrlChanged() {
		$("external_url_info").toggle();
		$("action_info").toggle();		
	}
	
	function addParamToAction() {
		paramCount++;
		var htmlContent = '<li>Nombre del argumento: <input type="text" name="param[name][%count%]" value=""> Valor: <input type="text" name="param[value][%count%]" value=""><a href"#" onClick="deleteParamFromAction(this); return false;" alt="Eliminar" title="Eliminar" ><img src="images/clear.png" class="linkImageDelete"></a></li>';
		htmlContent = htmlContent.gsub("%count%", paramCount);
		$("params_list").insert(htmlContent);	
	}

	function deleteParamFromAction(anchorElement) {
		// no importa que los indices de los parametros sean consecutivos, solo que sean distintos. 
		// Por eso no hace falta hacer nada especial con paramCount al borrar.
		anchorElement.parentNode.remove();
	}
</script>

	<h2>Módulo de Menús</h2>
	<h1>Administrar Menús</h1>
	
	<p>Ingrese la información solicitada y haga click en "Guardar"</p>
	<fieldset>
		<legend>|-if isset($create)-|Agregar |-/if-|Menú</legend>
		
		<form id="editors_here" action="Main.php?do=commonMenuItemsDoEdit" method="post">
			<input name="menuItem[parentId]" type="hidden" id="menuItem[parentId]" value="|-$parentId-|" />
			<input name="menuItem[id]" type="hidden" id="menuItem[id]" value="|-$menuItem->getId()-|" /> 

				<p>Informacion del enlace</p>
				<p><label for="useExternalUrl">URL</label>
					<input type="radio" name="useExternalUrl" |-if !$menuItem->usingExternalUrl()-|checked="true"|-/if-| value="false" onclick="useExternalUrlChanged();" /> Usar enlace interno
					<input type="radio" name="useExternalUrl" value="true" |-if $menuItem->usingExternalUrl()-|checked="true"|-/if-| onclick="useExternalUrlChanged();" /> Usar enlace externo
				</p>
				<div id="external_url_info" |-if !$menuItem->usingExternalUrl()-| style="display: none;" |-/if-|>
					<label>Url: </label>
					<input type="text" name="menuItem[url]" id="menuItem[url]" value="|-$menuItem->getUrl()-|" />
				</div>
				<div id="action_info" |-if $menuItem->usingExternalUrl()-| style="display: none;" |-/if-| style="position: relative;">
					<div style="float: left;">
					|-include file="CommonAutocompleterInstanceInclude.tpl" label="Acción: " id="autocompleter_actions" url="Main.php?do=commonMenuItemsActionsAutocompleteListX" afterUpdateElement="getSelectionActionInfo"-|
					<input type="hidden" id="menuItem_action" name="menuItem[action]" value="|-$menuItem->getAction()-|"/>
					</div>
					<a href="#" onclick="addParamToAction(); return false;" alt="Agregar argumento" title="Agregar argumento"><img src="images/clear.png" class="linkImageAdd" /></a>
					<a href="#" onclick="getDefaultInfo(); return false;" alt="Obtener valores por defecto" title="Obtener valores por defecto"><img src="images/clear.png" class="linkImageEmail" /></a>
					<!-- por algun extraño motivo usar el indicator1 para indicar la demora en obtener la informacion de idioma no funciona -->
					<span id="indicator2" style="display: none">
	  					<img src="images/spinner.gif" alt="Procesando..." />
					</span>
					<div style="clear: both;"></div>
					<ul id="params_list">
					|-foreach from=$params key=key item=value name=it_params-|
						<li>Nombre del argumento: <input type="text" name="param[name][]" value="|-$key-|"> Valor: <input type="text" name="param[value][]" value="|-$value-|"><a href"#" onClick="deleteParamFromAction(this); return false;" alt="Eliminar" title="Eliminar" ><img src="images/clear.png" class="linkImageDelete"></a></li>
					|-/foreach-|
					</ul>
				</div>
				<p>
					<label for="menuItem[newWindow]">Abrir en nueva ventana</label><input type="checkbox" name="menuItem[newWindow]" |-$menuItem->getNewWindow()|checked_bool-| /> 
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
	
	|-if !isset($create) -|
	<fieldset>
		<legend>Vista Preliminar</legend>
		|-include_module module=Common action=MenuItemsShow options="template=CommonMenuItemsHorizontalView.tpl&id="|cat:$menuItem->getId()-|
	</fieldset>
	|-/if-|

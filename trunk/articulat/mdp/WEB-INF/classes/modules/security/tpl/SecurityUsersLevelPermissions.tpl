|-capture "statusIcons"-|
	<img class="resultStatus yes" style="display: none;" src="images/icon_yes.png">
	<img class="resultStatus no" style="display: none;" src="images/icon_no.png">
	<img class="spinner" style="display: none;" src="images/icon_spinner.gif">
|-/capture-|
<h2>Seguridad</h2>
<h1>Administrar permisos por nivel de usuario</h1>
<p>A continuación puede seleccionar un nivel de usuario en el selector y asignar lso permisos por módulo o por acción marcando la casilla al lado de cada uno.<br>
El sistema guardará la elección al momento de marcar la casilla y de ser satisfactorio mostrará un ícono como resultado del mismo.</p>
<fieldset id="securityLevel">
<legend>Permisos por nivel</legend>
<div id="sidebar">
	<form method="GET" action="Main.php">
	<p>Seleccione un nivel de usuario</p>
		<input type="hidden" name="do" value="securityUsersLevelPermissions">
		<select name="userBitLevel" onchange="this.form.submit();">
			|-foreach $userLevels as $userLevel-|
				<option value="|-$userLevel->getBitLevel()-|" |-$userLevel->getBitLevel()|selected:$userBitLevel-|>|-$userLevel->getName()-|</option>
			|-/foreach-|
			<option value="noCheckLogin" |-'noCheckLogin'|selected:$userBitLevel-|>noCheckLogin</option>
		</select>
	</form>
	<div class="filter">
		<label>filtrar por nombre</label>
		<div>
			<button onclick="clearFilterByName();" title="Quitar filtro">x</button>
			<input id="name-filter-input" type="text" onkeyup="filterByName(this.value);" title="Ingrese el texto a buscar. El buscador es sensible a mayúsculas y minúsculas">
		</div>
	</div>
</div>
<div id="content">
	<table cellpadding="0" cellspacing="0" class="modules">
		<tr id="allActions">
			<td colspan="4">
				Setear permisos para todos las acciones visibles &nbsp;	<button onclick="if (confirm('Este método actúa solo sobre acciones!. \n¿Está seguro que desea permitir el acceso a todos los actions visibles?')) setVisibleActionsAccess(true);"class="icon iconAdd" title="Agregar permisos al nivel de usuario seleccionado para todas las acciones visibles"> + </button> &nbsp;	
				<button onclick="if (confirm('Este método actúa solo sobre acciones!. \n¿ Está seguro que desea impedir el acceso a todos los actions visibles?')) setVisibleActionsAccess(false);"class="icon iconClose" title="Remover permisos al nivel de usuario seleccionado para todas las acciones visibles"> - </button>
				|-$smarty.capture.statusIcons-|
			</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;
			</td>
		</tr>
		<tr id="noMatchesMsg" style="display: none;"><td height="50" colspan="4">
		  <div align="center"><strong>No hay coincidencias.</strong></div>
		</td>
		</tr>
		|-foreach $modules as $moduleName => $eachModule-|
			<tr id="module-|-$moduleName-|" class="module">
				<td colspan="4" class="name">
					<button class="collapse-button icon iconCollapse" onclick="collapse(this.parentNode.parentNode.id);" title="Ocultar acciones del módulo">-</button>
					<button class="expand-button icon iconExpand" onclick="expand(this.parentNode.parentNode.id);" style="display: none;" title="Mostrar acciones del módulo">+</button>
				&nbsp; &nbsp;
					|-if $userBitLevel neq 'noCheckLogin'-|
						|-if $eachModule.access.all-|
							<input class="access" type="checkbox" disabled="disabled" checked="true">
							access allowed for all users
						|-else-|
							<input class="access" type="checkbox" |-$eachModule.access.bitLevel|checked_if_has_access:$userBitLevel-| onchange="setModuleAccess(this.parentNode.parentNode.id, this.checked)">
						|-/if-|
					|-else-|
						<input class="access" type="checkbox" |-$eachModule.access.noCheckLogin|checked:1-| onchange="setModuleAccess(this.parentNode.parentNode.id, this.checked)">
					|-/if-|
					|-$smarty.capture.statusIcons-|
				&nbsp; &nbsp; |-$moduleName|multilang_get_translation:"common"-| <em>(|-$moduleName-|)</em> </td>
			</tr>
			|-foreach $eachModule.actions as $action => $access-|
				<tr id="action-|-$action-|" class="action module-|-$moduleName-|-action|-if $access@last-| last|-/if-|">
					<td>&nbsp;</td>
					<td>&nbsp; &nbsp;
						|-if $userBitLevel neq 'noCheckLogin'-|
							|-if $access.all-|
								<input class="access" type="checkbox" disabled="disabled" checked="true">
								access allowed for all users
							|-else-|
								<input class="access" type="checkbox" |-$access.bitLevel|checked_if_has_access:$userBitLevel-| onchange="setActionAccess(this.parentNode.parentNode.id, this.checked)">
							|-/if-|
						|-else-|
							<input class="access" type="checkbox" |-$access.noCheckLogin|checked:1-| onchange="setActionAccess(this.parentNode.parentNode.id, this.checked)">
						|-/if-|
						|-$smarty.capture.statusIcons-|
					</td>
					<td class="name">|-$action|multilang_get_actionLabel_translation-|<br/><em>(|-$action-|)</em></td>
					<td>|-$action|multilang_get_action_description-|</td>
				</tr>
			|-/foreach-|
		|-/foreach-|
	</table>
</div>
</fieldset>

<script>

	getErrors = function(response) {
		try {
			var responseData = JSON.parse(response.responseText);
			return responseData.errors;
		} catch(e) {
			return { unknown: 'Se produjo un error desconocido' }
		}
	};
	
	setAccess = function(type, name, access) {
		
		if (type != 'module' && type != 'action')
			throw 'unknown type';
		
		var params = {};
		params.access = access ? 'yes' : 'no';
		params.bitLevel = '|-$userBitLevel-|';
		params[type] = name.replace(new RegExp('^'+type+'-'), '');
		
		sendAccessChangeRequest(params, $(name), function(response) {

			if (getErrors(response))
				$(name).select('.access').first().checked = !access; // Rollback status change

		});
	};
	
	setModuleAccess = function(module, access) {
		setAccess('module', module, access);
	};
	
	setActionAccess = function(action, access) {
		setAccess('action', action, access);
	};
	
	setVisibleActionsAccess = function(access) {
		
		var visibleActionsSelector = '.action:not(.filtered-out):not(.collapsed-module)';
		
		var actions = [];
		$$(visibleActionsSelector).each(function(e, i){
			if (e.select('.access:enabled').length > 0)
			actions.push(e.id.replace(/^action-/, ''));
		});
		
		var params = {
			"access": access ? 'yes' : 'no',
			"bitLevel": '|-$userBitLevel-|',
			"action[]": actions
		}
		
		sendAccessChangeRequest(params, $('allActions'), function(response) {
			
			if (!getErrors(response)) {
				$$(visibleActionsSelector).each(function(e, i){
					e.select('.access').first().checked = access;
				});
			}
		});
	};
	
	sendAccessChangeRequest = function(params, statusIconsContainer, successCb) {
		
		statusIconsContainer.select('.resultStatus').each(function(e, i) { e.hide(); } );
		statusIconsContainer.select('.spinner').first().show();
		
		new Ajax.Request('Main.php?do=securityDoEditPermissionsV2', {
			method: 'POST',
			parameters: params,
			onSuccess: function(response) {
				
				statusIconsContainer.select('.spinner').first().hide();
				var selector = getErrors(response) ? '.no' : '.yes';
				statusIconsContainer.select(selector).first().show();
				
				successCb(response);
			}
		});
	};
	
	collapse = function(elemId) {
		$$('.'+elemId+'-action').each(function(e, i) { e.addClassName('collapsed-module'); });
		$$('#'+elemId+' .collapse-button').each(function(e, i) { e.hide(); });
		$$('#'+elemId+' .expand-button').each(function(e, i) { e.show(); });
	};
	
	expand = function(elemId) {
		$$('.'+elemId+'-action').each(function(e, i) { e.removeClassName('collapsed-module'); });
		$$('#'+elemId+' .collapse-button').each(function(e, i) { e.show(); });
		$$('#'+elemId+' .expand-button').each(function(e, i) { e.hide(); });
	};
	
	filterByName = function(value) {
		
		var value = value.trim().replace(' ', '.*', 'g');
		var regex = new RegExp(value);
		
		$$('.action').each(function(e, i) {
			filterByCond(e, e.id.match(regex));
		});
		
		$$('.module').each(function(e, i) {
			filterByCond(e, $$('.'+e.id+'-action:not(.filtered-out)').length > 0);
		});
		
		if ($$('.modules .module:not(.filtered-out)').length > 0)
			$('noMatchesMsg').hide();
		else
			$('noMatchesMsg').show();
	};
	
	filterByCond = function(elem, cond) {
		if (cond)
			elem.removeClassName('filtered-out');
		else
			elem.addClassName('filtered-out');
	};
	
	clearFilterByName = function() {
		$('name-filter-input').clear().onkeyup();
	};
	
	Event.observe(window, 'load', function() {
		$('name-filter-input').focus();
	});
</script>

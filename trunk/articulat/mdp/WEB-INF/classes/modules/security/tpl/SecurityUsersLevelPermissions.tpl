<style>
	#sidebar {
		position: fixed;
		width: 210px;
		border-right: 1px solid #aaaaaa;
	}
	
	#content {
		margin-left: 210px;
	}
	
	.filter {
		border-top: 1px solid #aaaaaa;
		margin-top: 10px;
	}
	
	.modules {
		margin-left: 20px;
	}
	
	tr:hover {
		background-color: #d6f8ef;
	}
	
	.action .name {
		padding-left: 40px;
	}
	
	.collapsed-module {
		display: none;
	}
	
	.filtered-out {
		display: none;
	}
</style>

|-capture "statusIcons"-|
	<img class="resultStatus yes" style="display: none;" src="images/icon_yes.png">
	<img class="resultStatus no" style="display: none;" src="images/icon_no.png">
	<img class="spinner" style="display: none;" src="images/icon_spinner.gif">
|-/capture-|
<div id="sidebar">
	<form method="GET" action="Main.php">
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
			<button onclick="clearFilterByName();">x</button>
			<input id="name-filter-input" type="text" onkeyup="filterByName(this.value);">
		</div>
	</div>
</div>
<div id="content">
	<table class="modules">
		<tr id="allActions">
			<td>
				Setear permisos para todos los actions visibles
			</td>
			<td>
				<button onclick="if (confirm('seguro que desea permitir el acceso a todos los actions visibles?')) setVisibleActionsAccess(true);">+</button>
				<button onclick="if (confirm('seguro que desea impedir el acceso a todos los actions visibles?')) setVisibleActionsAccess(false);">-</button>
				|-$smarty.capture.statusIcons-|
			</td>
		</tr>
		<tr id="noMatchesMsg" style="display: none;"><td>No hay coincidencias.</td></tr>
		|-foreach $modules as $moduleName => $module-|
			<tr id="|-$moduleName-|" class="module">
				<td>
					<button class="collapse-button" onclick="collapse(this.parentNode.parentNode.id);">-</button>
					<button class="expand-button" onclick="expand(this.parentNode.parentNode.id);" style="display: none;">+</button>
					<span>|-$moduleName-|</span>
					|-if $userBitLevel neq 'noCheckLogin'-|
						|-if $module.access.all-|
							<input class="access" type="checkbox" disabled="disabled" checked="true">
							access allowed for all users
						|-else-|
							<input class="access" type="checkbox" |-$module.access.bitLevel|checked_if_has_access:$userBitLevel-| onchange="setModuleAccess(this.parentNode.parentNode.id, this.checked)">
						|-/if-|
					|-else-|
						<input class="access" type="checkbox" |-$module.access.noCheckLogin|checked:1-| onchange="setModuleAccess(this.parentNode.parentNode.id, this.checked)">
					|-/if-|
					|-$smarty.capture.statusIcons-|
				</td>
			</tr>
			|-foreach $module.actions as $action => $access-|
				<tr id="|-$action-|" class="action |-$moduleName-|-action">
					<td class="name">|-$action-|</td>
					<td>
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
				</tr>
			|-/foreach-|
		|-/foreach-|
	</table>
</div>

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
		params[type] = name;
		
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
			actions.push(e.id);
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
		
		console.log('chequear en el action que el usuario esté autorizado a cambiar los permisos!');
		
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

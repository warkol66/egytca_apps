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
	
	<ul>
		<li>falta implementar las llamadas por ajax: cambiar un checkbox no tiene efecto</li>
		<li>falta ocultar acciones con pares</li>
		<li>checkbox del módulo completo no se marca con el estado real. Sin implementar</li>
	</ul>
	
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
		|-foreach $actions as $module => $moduleActions-|
			<tr id="|-$module-|" class="module non-filtered">
				<td>
					<button class="collapse-button" onclick="collapse(this.parentNode.parentNode.id);">-</button>
					<button class="expand-button" onclick="expand(this.parentNode.parentNode.id);" style="display: none;">+</button>
					<span>|-$module-|</span>
					<input type="checkbox">
				</td>
			</tr>
			|-foreach $moduleActions as $action => $access-|
				<tr id="|-$action-|" class="action non-filtered |-$module-|-action">
					<td class="name">|-$action-|</td>
					<td>
						|-if $userBitLevel neq 'noCheckLogin'-|
							<input class="access" type="checkbox" |-$access.bitLevel|checked_if_has_access:$userBitLevel-| onchange="setActionAccess(this.parentNode.parentNode.id, this.checked)">
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
	
	setActionAccess = function(action, access) {
		
		$(action).select('.resultStatus').each(function(e, i) { e.hide(); } );
		$(action).select('.spinner').first().show();
		
		sendActionAccessRequest(action, access, function(response) {
			
			$(action).select('.spinner').first().hide();
			
			if (getErrors(response)) {
				$(action).select('.no').first().show();
				$(action).select('.access').first().checked = !access; // Rollback status change
			} else {
				$(action).select('.yes').first().show();
			}
		});
	};
	
	setVisibleActionsAccess = function(access) {
		
		var actions = [];
		$$('.action.non-filtered:not(.collapsed-module)').each(function(e, i){
			actions.push(e.id);
		});
		
		$('allActions').select('.resultStatus').each(function(e, i) { e.hide(); } );
		$('allActions').select('.spinner').first().show();
		
		sendActionAccessRequest(actions, access, function(response) {
			
			$('allActions').select('.spinner').first().hide();
			
			if (getErrors(response)) {
				$('allActions').select('.no').first().show();
			} else {
				$('allActions').select('.yes').first().show();
				$$('.action.non-filtered:not(.collapsed-module)').each(function(e, i){
					e.select('.access').first().checked = access;
				});
			}
		});
	};
	
	sendActionAccessRequest = function(action, access, successCb) {
	
		console.log('chequear en el action que el usuario esté autorizado a cambiar los permisos!');
		
		var params = {};
		params.access = access ? 'yes' : 'no';
		if (action instanceof Array)
			params['action[]'] = action;
		else
			params.action = action;
		
		new Ajax.Request('Main.php?do=securityDoEditPermissionsV2', {
			method: 'POST',
			parameters: params,
			onSuccess: successCb
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
		var regex = new RegExp(value, 'i');
		
		$$('.action').each(function(e, i) {
			filterByCond(e, e.id.match(regex));
		});
		
		$$('.module').each(function(e, i) {
			filterByCond(e, $$('.'+e.id+'-action.non-filtered').length > 0);
		});
		
		if ($$('.modules .module.non-filtered').length > 0)
			$('noMatchesMsg').hide();
		else
			$('noMatchesMsg').show();
	};
	
	filterByCond = function(elem, cond) {
		if (cond) {
			elem.show();
			elem.addClassName('non-filtered');
		} else {
			elem.hide();
			elem.removeClassName('non-filtered');
		}
	};
	
	clearFilterByName = function() {
		$('name-filter-input').clear().onkeyup();
	};
	
	Event.observe(window, 'load', function() {
		$('name-filter-input').focus();
	});
</script>

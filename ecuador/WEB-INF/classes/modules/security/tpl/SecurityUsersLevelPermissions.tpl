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
				Setear permisos para todos las acciones visibles &nbsp;	<button onclick="if (confirm('Este método actúa solo sobre acciones!. \n¿Está seguro que desea permitir el acceso a todos los actions visibles?')) setVisibleActionsAccess(true);">+</button>
				<button onclick="if (confirm('Este método actúa solo sobre acciones!. \n¿ Está seguro que desea impedir el acceso a todos los actions visibles?')) setVisibleActionsAccess(false);">-</button>
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
			<tr id="|-$moduleName-|" class="module">
				<td colspan="4" class="name">
					<button class="collapse-button" onclick="collapse(this.parentNode.parentNode.id);">-</button>
					<button class="expand-button" onclick="expand(this.parentNode.parentNode.id);" style="display: none;">+</button>
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
				<tr id="|-$action-|" class="action |-$moduleName-|-action|-if $access@last-| last|-/if-|">
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
	
	setAccess = function(type, name, access) {
		
		if (type != 'module' && type != 'action')
			throw 'unknown type';
		
		var params = {};
		params.access = access ? 'yes' : 'no';
		params.bitLevel = '|-$userBitLevel-|';
		params[type] = name;
		
		sendAccessChangeRequest(params, name, function(data, textStatus, jqXHR) {
			if (data.errors)
				$('#'+name+' .access').first().attr('checked', !access); // Rollback status change
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
		$(visibleActionsSelector).each(function() {
			if ($(this).find('.access:enabled').length > 0)
			actions.push(this.id);
		});
		
		var params = {
			"access": access ? 'yes' : 'no',
			"bitLevel": '|-$userBitLevel-|',
			"action[]": actions
		}
		
		sendAccessChangeRequest(params, 'allActions', function(data, textStatus, jqXHR) {
			
			if (!data.errors) {
				$(visibleActionsSelector).each(function() {
					$(this).find('.access').first().attr('checked', access);
				});
			}
		});
	};
	
	sendAccessChangeRequest = function(params, statusIconsContainerId, successCb) {
		
		console.log('chequear en el action que el usuario esté autorizado a cambiar los permisos!');
		
		$('#'+statusIconsContainerId).find('.resultStatus').hide();
		$('#'+statusIconsContainerId).find('.spinner').first().show();
		
		$.post('Main.php?do=securityDoEditPermissionsV2', params, function(data, textStatus, jqXHR) {
			
			$('#'+statusIconsContainerId).find('.spinner').first().hide();
			var selector = data.errors ? '.no' : '.yes';
			$('#'+statusIconsContainerId).find(selector).first().show();
			
			successCb(data, textStatus, jqXHR);
		}, 'json');
	};
	
	collapse = function(elemId) {
		$('.'+elemId+'-action').addClass('collapsed-module');
		$('#'+elemId+' .collapse-button').hide();
		$('#'+elemId+' .expand-button').show();
	};
	
	expand = function(elemId) {
		$('.'+elemId+'-action').removeClass('collapsed-module');
		$('#'+elemId+' .collapse-button').show();
		$('#'+elemId+' .expand-button').hide();
	};
	
	filterByName = function(value) {
		
		var value = value.trim().replace(' ', '.*', 'g');
		var regex = new RegExp(value);
		
		$('.action').each(function() {
			filterByCond(this, this.id.match(regex));
		});
		
		$('.module').each(function() {
			filterByCond(this, $('.'+this.id+'-action:not(.filtered-out)').length > 0);
		});
		
		if ($('.modules .module:not(.filtered-out)').length > 0)
			$('#noMatchesMsg').hide();
		else
			$('#noMatchesMsg').show();
	};
	
	filterByCond = function(elem, cond) {
		if (cond)
			$(elem).removeClass('filtered-out');
		else
			$(elem).addClass('filtered-out');
	};
	
	clearFilterByName = function() {
		$('#name-filter-input').clear().onkeyup();
	};
	
	$(function() {
		$('#name-filter-input').focus();
	});
</script>

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
</style>

<div id="sidebar">
	<form method="GET" action="Main.php">
		<input type="hidden" name="do" value="securityRenameMe">
		<select name="userBitLevel" onchange="this.form.submit();">
			|-foreach $userLevels as $userLevel-|
				<option value="|-$userLevel->getBitLevel()-|" |-$userLevel->getBitLevel()|selected:$userBitLevel-|>|-$userLevel-|</option>
			|-/foreach-|
			<option value="noCheckLogin" |-'noCheckLogin'|selected:$userBitLevel-|>noCheckLogin</option>
		</select>
	</form>
	<div>Sin implementar...</div>
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
		<tr id="noMatchesMsg" style="display: none;"><td>No hay coincidencias.</td></tr>
		|-foreach $actions as $module => $moduleActions-|
			<tr id="|-$module-|" class="module visible">
				<td>
					<button class="collapse-button" onclick="collapse(this.parentNode.parentNode.id);">-</button>
					<button class="expand-button" onclick="expand(this.parentNode.parentNode.id);" style="display: none;">+</button>
					<span>|-$module-|</span>
				</td>
				<td><input type="checkbox"></td>
			</tr>
			|-foreach $moduleActions as $action => $access-|
				<tr id="|-$action-|" class="action visible |-$module-|-action">
					<td class="name">|-$action-|</td>
					<td>
						|-if $userBitLevel neq 'noCheckLogin'-|
							<input type="checkbox" |-$access.bitLevel|checked_if_has_access:$userBitLevel-|>
						|-else-|
							<input type="checkbox" |-$access.noCheckLogin|checked:1-| onchange="randomResult(this.parentNode)">
						|-/if-|
						<img class="status yes" style="display: none;" src="images/icon_yes.png">
						<img class="status no" style="display: none;" src="images/icon_no.png">
						<img class="spinner" style="display: none;" src="images/icon_spinner.gif">
					</td>
				</tr>
			|-/foreach-|
		|-/foreach-|
	</table>
</div>
<script>
	randomResult = function(elem) {
		
		$$('.status').each(function(e, i) { e.hide(); });
		
		elem.select('.spinner').first().show();
		setTimeout(function() {
			var selector = Math.random() > 0.5 ? '.yes' : '.no';
			elem.select('.spinner').first().hide();
			elem.select(selector).first().show();
		}, 1000);
	};
	
	collapse = function(elemId) {
		$$('.'+elemId+'-action').each(function(e, i) { e.hide(); });
		$$('#'+elemId+' .collapse-button').each(function(e, i) { e.hide(); });
		$$('#'+elemId+' .expand-button').each(function(e, i) { e.show(); });
	};
	
	expand = function(elemId) {
		$$('.'+elemId+'-action').each(function(e, i) { e.show(); });
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
			filterByCond(e, $$('.'+e.id+'-action.visible').length > 0);
		});
		
		if ($$('.modules .module.visible').length > 0)
			$('noMatchesMsg').hide();
		else
			$('noMatchesMsg').show();
	};
	
	filterByCond = function(elem, cond) {
		if (cond) {
			elem.show();
			elem.addClassName('visible');
		} else {
			elem.hide();
			elem.removeClassName('visible');
		}
	};
	
	clearFilterByName = function() {
		$('name-filter-input').clear().onkeyup();
	};
	
	Event.observe(window, 'load', function() {
		$('name-filter-input').focus();
	});
</script>

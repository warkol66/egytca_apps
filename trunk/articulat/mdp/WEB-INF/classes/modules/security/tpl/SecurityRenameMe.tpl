<style>
	.modules {
		padding-left: 20px;
	}
	
	.actions {
		padding-left: 40px;
	}
	
	.action {
		border: 1px solid transparent;
	}
	
	.action:hover {
		border-color: #aaaaaa;
		background-color: #d6f8ef;
	}
	
	#sidebar {
		position: fixed;
		width: 210px;
		border-right: 1px solid #aaaaaa;
	}
	
	#content {
		padding-left: 210px;
	}
	
	.filter {
		border-top: 1px solid #aaaaaa;
	}
</style>

<div id="sidebar">
	<form method="GET" action="Main.php">
		<input type="hidden" name="do" value="securityRenameMe">
		<select name="userBitLevel" onchange="this.form.submit();">
			|-foreach $userLevels as $userLevel-|
				<option value="|-$userLevel->getBitLevel()-|" |-$userLevel->getBitLevel()|selected:$userBitLevel-|>|-$userLevel-|</option>
			|-/foreach-|
		</select>
	</form>
	<p>Sin implementar...</p>
	<div class="filter">
		<p><label>filtrar por nombre</label></p>
		<p>
			<button onclick="clearFilterByName();">x</button>
			<input id="name-filter-input" type="text" onkeyup="filterByName(this.value);">
		</p>
	</div>
</div>
<div id="content">
	<ul class="modules">
		<li id="noMatchesMsg" style="display: none;">No hay coincidencias.</li>
		|-foreach $actions as $module => $moduleActions-|
			<li id="|-$module-|" class="module visible">
				<p>
					<button class="collapse-button" onclick="collapse(this.parentNode.parentNode.id);">-</button>
					<button class="expand-button" onclick="expand(this.parentNode.parentNode.id);" style="display: none;">+</button>
					<span>|-$module-|</span>
				</p>
				<ul class="actions">
					|-foreach $moduleActions as $action => $access-|
						<li id="|-$action-|" class="action visible">
							|-$action-|
							<span>
								<input type="checkbox" |-$access.bitLevel|checked_if_has_access:$userBitLevel-|>
								acceso
							</span>
							<span>
								<input type="checkbox" |-$access.noCheckLogin|checked:1-|>
								noCheckLogin
							</span>
						</li>
					|-/foreach-|
				</ul>
			</li>
		|-/foreach-|
	</ul>
</div>
<script>
	collapse = function(elemId) {
		$$('#'+elemId+' .actions').each(function(e, i) { e.hide(); });
		$$('#'+elemId+' .collapse-button').each(function(e, i) { e.hide(); });
		$$('#'+elemId+' .expand-button').each(function(e, i) { e.show(); });
	};
	
	expand = function(elemId) {
		$$('#'+elemId+' .actions').each(function(e, i) { e.show(); });
		$$('#'+elemId+' .collapse-button').each(function(e, i) { e.show(); });
		$$('#'+elemId+' .expand-button').each(function(e, i) { e.hide(); });
	};
	
	filterByName = function(value) {
		
		var value = value.trim();
		
		$$('.action').each(function(e, i) {
			var regex = new RegExp(value, 'i');
			filterByCond(e, e.id.match(regex));
		});
		
		$$('.module').each(function(e, i) {
			filterByCond(e, $$('#'+e.id+' .action.visible').length > 0);
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
</script>

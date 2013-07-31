<style>
	.modules {
		overflow-y: scroll;
		height: 400px;
	}
	
	.actions {
		padding-left: 40px;
	}
	
	.action:hover {
		border: 1px solid #aaaaaa;
		background-color: #d6f8ef;
	}
	
	.sidebar {
		float:left;
		width: 200px;
		border-right: 1px solid #aaaaaa;
	}
	
	.filter {
		border-top: 1px solid #aaaaaa;
	}
</style>

<div class="sidebar">
	<div>
		|-foreach $userLevels as $userLevel-|
			<p><input type="checkbox">|-$userLevel-|</p>
		|-/foreach-|
	</div>
	<span>Sin implementar...</span>
	<div class="filter">
		<p><label>filtrar por nombre</label></p>
		</p><input type="text" onkeyup="filterByName(this.value);"></p>
	</div>
</div>
<ul class="modules">
	<li id="noMatchesMsg" style="display: none;">No hay coincidencias.</li>
	|-foreach $actions as $module => $moduleActions-|
		<li id="|-$module-|" class="module visible">
			<p>|-$module-|</p>
			<ul class="actions">
				|-foreach $moduleActions as $action-|
					<li id="|-$action-|" class="action visible">|-$action-|
				|-/foreach-|
			</ul>
		</li>
	|-/foreach-|
</ul>

<script>
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
</script>

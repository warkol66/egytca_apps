<style>
	.modules {
		overflow-y: scroll;
		height: 400px;
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
		<p><input type="text" onkeyup="filterByName(this.value);"></p>
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

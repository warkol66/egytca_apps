<script type='text/javascript'>
	function selectRole(roleValue) {
		new Ajax.Updater (
			'div_role',
			'Main.php?do=headlinesSelectActorRole',
			{
				method: 'get',
				parameters: {
					headlineId: |-$headlineId-|,
					actorId: |-$actorId-|,
					role: roleValue
				}
			});
	}

	function displaySelect() {
		$('p_role').hide();
		$('select_role').show();
	}
</script>

<div id='div_role'>
<p id='p_role' |-if $action neq 'show'-|style="display:none;"|-/if-| onMouseOver='this.style.background="yellow";' onMouseOut='this.style.background="white";' onClick='displaySelect();'>|-$role-|</p>
<select id='select_role' |-if $action eq 'show'-|style="display:none;"|-/if-| onChange='selectRole(this.value);'>
	<option value='non'>-select a role-</option>
	<option value='spokesman'>spokesman</option>
	<option value='mention'>mention</option>
</select>
</div>
<script type='text/javascript'>
	function selectRole(actorId, roleValue) {
		new Ajax.Updater (
			'div_role_for_'+actorId,
			'Main.php?do=headlinesSelectActorRole',
			{
				method: 'get',
				parameters: {
					headlineId: |-$headlineId-|,
					actorId: actorId,
					role: roleValue
				}
			});
	}

	function displayRoleSelector(actorId) {
		$('p_role_for_'+actorId).hide();
		$('select_role_for_'+actorId).show();
	}
</script>


<div id='div_role_for_|-$actorId-|'>

|-if $action eq 'init'-|
<script>
window.onLoad=selectRole('|-$actorId-|', '');
</script>

|-else-|

<p id='p_role_for_|-$actorId-|' |-if $action neq 'show'-|style="display:none;"|-/if-| onMouseOver='this.style.background="yellow";' onMouseOut='this.style.background="white";' onClick='displayRoleSelector(|-$actorId-|);'>|-$roles[$role]-|</p>
<select id='select_role_for_|-$actorId-|' |-if $action eq 'show'-|style="display:none;"|-/if-| onChange='selectRole("|-$actorId-|", this.value);'>
	<option value=''>-select a role-</option>
|-foreach from=$roles key=roleKey item=roleString-|
	<option value='|-$roleKey-|'>|-$roleString-|</option>
|-/foreach-|
</select>

|-/if-|

</div>
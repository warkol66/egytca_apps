
<p id='p_role_for_|-$actorId-|' |-if $action neq 'show'-|style="display:none;"|-else-|style="display:inline;"|-/if-| onMouseOver='this.className="in_place_hover";' onMouseOut='this.className="in_place_editable";' onClick='displayRoleSelector(|-$actorId-|);'>|-$roles[$role]-|</p>
<select id='select_role_for_|-$actorId-|' |-if $action eq 'show'-|style="display:none;"|-else-|style="display:inline;"|-/if-| onChange='selectRole("|-$actorId-|", this.value);'>
	<option value=''>Seleccione un rol</option>
|-foreach from=$roles key=roleKey item=roleString-|
	<option value='|-$roleKey-|' |-if $role eq $roleKey-|selected='selected'|-/if-|>|-$roleString-|</option>
|-/foreach-|
</select>
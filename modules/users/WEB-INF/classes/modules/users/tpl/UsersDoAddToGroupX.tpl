<script type="text/javascript" language="javascript" >
	$('groupMsgField').innerHTML = '<span class="resultSuccess">Usuario agregado a Grupo</span>';
	option = $('groupOption|-$group->getId()-|');
	if (option != null) {
		Element.remove('groupOption|-$group->getId()-|');
	}
	
</script>

<li id="groupListItem|-$group->getId()-|">
	|-$group->getName()-|
	<form  method="post">
		<input type="hidden" name="do" id="do" value="usersDoDeleteFromGroupX" />
		<input type="hidden" name="userId"  value="|-$currentUser->getId()-|" />
		<input type="hidden" name="groupId"  value="|-$group->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:usersDoDeleteFromGroup(this.form)" class="iconDelete" />
	</form>
</li>

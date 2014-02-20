<script type="text/javascript" language="javascript" >
	$('#groupMsgField').html('<span class="resultSuccess">Usuario agregado a Grupo</span>');
	$('#groupOption|-$group->getId()-|').remove();
</script>

<li id="groupListItem|-$group->getId()-|">
	<form  method="post">
		<input type="button" value="Eliminar" onClick="javascript:usersDoDeleteFromGroup(this.form)" class="icon iconDelete" />
		<input type="hidden" name="do" id="do" value="usersDoDeleteFromGroupX" />
		<input type="hidden" name="userId"  value="|-$currentUser->getId()-|" />
		<input type="hidden" name="groupId"  value="|-$group->getId()-|" />	
	</form>
	|-$group->getName()-|
</li>

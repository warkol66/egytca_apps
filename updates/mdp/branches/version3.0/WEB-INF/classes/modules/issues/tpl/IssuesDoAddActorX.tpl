<script type="text/javascript" language="javascript" >
	$('actorMsgField').innerHTML = '<span class="resultSuccess">Actor agregado</span>';
</script>

<li id="actorListItem|-$actor->getId()-|">
	<form  method="post">
		<input type="hidden" name="do" id="do" value="issuesDoRemoveActorX" />
		<input type="hidden" name="issueId"  value="|-$issueId-|" />
		<input type="hidden" name="actorId"  value="|-$actor->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:removeActorFromIssue(this.form)" class="icon iconDelete" />
	</form>	|-$actor-|
</li>

<script type="text/javascript" language="javascript" >
	$('actorMsgField').innerHTML = '<span class="resultSuccess">Actor agregado</span>';
</script>

<li id="actorListItem|-$actor->getId()-|">
	<form  method="post">
		<input type="hidden" name="do" id="do" value="headlinesDoRemoveActorX" />
		<input type="hidden" name="headlineId"  value="|-$headlineId-|" />
		<input type="hidden" name="actorId"  value="|-$actor->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:removeActorFromHeadline(this.form)" class="icon iconDelete" />
	</form>	|-$actor->getName()-|
</li>

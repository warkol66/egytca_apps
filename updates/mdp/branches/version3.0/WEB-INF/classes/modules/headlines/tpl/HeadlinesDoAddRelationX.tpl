<script type="text/javascript" language="javascript" >
	$('relationMsgField').innerHTML = '<span class="resultSuccess">Titular agregado</span>';
</script>

<li id="relationListItem|-$relation->getId()-|">
	<form  method="post">
		<input type="hidden" name="do" id="do" value="headlinesDoRemoveRelationX" />
		<input type="hidden" name="headlineId"  value="|-$headlineId-|" />
		<input type="hidden" name="relationId"  value="|-$relation->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:removeRelationFromHeadline(this.form)" class="icon iconDelete" />
	</form>	|-$relation->getName()-|
</li>

<script type="text/javascript" language="javascript" >
	$('issueMsgField').innerHTML = '<span class="resultSuccess">Asunto agregado</span>';
</script>

<li id="issueListItem|-$issue->getId()-|">
	<form  method="post">
		<input type="hidden" name="do" id="do" value="headlinesDoRemoveIssueX" />
		<input type="hidden" name="headlineId"  value="|-$headlineId-|" />
		<input type="hidden" name="issueId"  value="|-$issue->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:removeIssueFromHeadline(this.form)" class="icon iconDelete" />
	</form>	|-$issue->getName()-|
</li>

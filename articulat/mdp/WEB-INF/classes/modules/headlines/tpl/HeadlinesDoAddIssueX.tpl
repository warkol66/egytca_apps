<script type="text/javascript" language="javascript" >
	$('issueMsgField').innerHTML = '<span class="resultSuccess">##issues,2,Asunto## agregado</span>';
</script>

<li id="issueListItem|-$issue->getId()-|">
	<form  method="post">
		<input type="hidden" name="do" id="do" value="headlinesDoRemoveIssueX" />
		<input type="hidden" name="headlineId"  value="|-$headlineId-|" />
		<input type="hidden" name="issueId"  value="|-$issue->getId()-|" />			
		<input type="button" value="Eliminar" onclick="if (confirm('Seguro que desea quitar el ##issues,4,asunto## del ##headlines,4,titular##?')) removeIssueFromHeadline(this.form);" class="icon iconDelete" />
	</form>	|-$issue->getName()-|
</li>

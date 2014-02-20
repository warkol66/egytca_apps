<script type="text/javascript" language="javascript">

	$('#groupListItem|-$group->getId()-|').remove();

	var option = $('<option>')
		.val('|-$group->getId()-|')
		.text('|-$group->getName()-|')
		.attr('id', 'groupOption|-$group->getId()-|');
	$('#groupId').append(option);
</script>
<span class="resultSuccess">Usuario removido del grupo</span>

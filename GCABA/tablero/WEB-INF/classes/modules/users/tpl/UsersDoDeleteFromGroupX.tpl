<script type="text/javascript" language="javascript">

	$('#groupListItem|-$group->getId()-|').remove();

	var option = document.createElement('option');
	option.text = '|-$group->getName()-|';
	option.value = '|-$group->getId()-|';
	option.id = 'groupOption|-$group->getId()-|';
	
	try {
		document.getElementById('groupId').add(option,null);
	}
	catch (exp) {
		document.getElementById('groupId').add(option);		
	}


</script>
<span class="resultSuccess">Usuario removido de grupo</span>

<script type="text/javascript" language="javascript">

	Element.remove('groupListItem|-$group->getId()-|');

	var option = document.createElement('option');
	option.text = '|-$group->getName()-|';
	option.value = '|-$group->getId()-|';
	option.id = 'groupOption|-$group->getId()-|';
	
	try {
		$('groupId').add(option,null);
	}
	catch (exp) {
		$('groupId').add(option);		
	}


</script>
<span class="resultSuccess">Usuario removido de grupo</span>

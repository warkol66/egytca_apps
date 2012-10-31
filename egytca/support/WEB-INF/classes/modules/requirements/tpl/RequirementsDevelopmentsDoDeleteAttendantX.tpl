<script type="text/javascript" language="javascript">

	Element.remove('#asocAttendantsListItem|-$resource->getId()-|');

	var option = document.createElement('option');
	option.text = '|-$attendant->getName()-|';
	option.value = '|-$attendant->getId()-|';
	option.id = 'attendantOption|-$attendant->getId()-|';
	
	try {
		$('attendantId').add(option,null);
	}
	catch (exp) {
		$('attendantId').add(option);		
	}


</script>
<span class="resultSuccess">Usuario removido de grupo</span>

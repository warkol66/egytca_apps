<script type="text/javascript" language="javascript">

	Element.remove('regionListItem|-$region->getId()-|');

	var option = document.createElement('option');
	option.text = '|-$region->getName()-|';
	option.value = '|-$region->getId()-|';
	option.id = 'regionOption|-$region->getId()-|';
	
	try {
		$('regionId').add(option,null);
	}
	catch (exp) {
		$('regionId').add(option);		
	}


</script>
<span class="resultSuccess">Región Eliminada</span>

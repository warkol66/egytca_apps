<script type="text/javascript" language="javascript">
	Element.remove('communeListItem|-$commune->getId()-|');
	var option = document.createElement('option');
	option.text = '|-$commune->getName()-|';
	option.value = '|-$commune->getId()-|';
	option.id = 'communeOption|-$commune->getId()-|';
	
	try {
		$('communeId').add(option,null);
	}
	catch (exp) {
		$('communeId').add(option);		
	}	

</script>
<span class="resultSuccess">Comuna Eliminada</span>

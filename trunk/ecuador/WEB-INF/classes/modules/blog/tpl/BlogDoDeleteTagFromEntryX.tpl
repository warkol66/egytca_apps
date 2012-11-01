<script type="text/javascript" language="javascript">

	Element.remove('tagListItem|-$tag->getId()-|');

	var option = document.createElement('option');
	option.text = '|-$tag->getName()-|';
	option.value = '|-$tag->getId()-|';
	option.id = 'categoryOption|-$tag->getId()-|';
	
	try {
		$('tagId').add(option,null);
	}
	catch (exp) {
		$('tagId').add(option);		
	}
</script>
<span class="resultSuccess">Etiqueta Eliminada</span>

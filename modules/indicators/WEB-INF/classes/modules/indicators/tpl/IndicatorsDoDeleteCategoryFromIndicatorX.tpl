<script type="text/javascript" language="javascript">

	Element.remove('categoryListItem|-$category->getId()-|');

	var option = document.createElement('option');
	option.text = '|-$category->getName()-|';
	option.value = '|-$category->getId()-|';
	option.id = 'categoryOption|-$category->getId()-|';
	
	try {
		$('categoryId').add(option,null);
	}
	catch (exp) {
		$('categoryId').add(option);		
	}
</script>
<span class="resultSuccess">Categoría Eliminada</span>

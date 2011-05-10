<script type="text/javascript" language="javascript" >
	$('categoryMsgField').innerHTML = '<span class="resultSuccess">Categoría Agregada</span>';
	option = $('categoryOption|-$category->getId()-|');
	if (option != null) {
		Element.remove('categoryOption|-$category->getId()-|');
	}
</script>

<li id="categoryListItem|-$category->getId()-|">
	|-$category->getName()-|
	<form  method="post">
		<input type="hidden" name="do" id="do" value="indicatorsDoDeleteCategoryFromIndicatorX" />
		<input type="hidden" name="indicatorId"  value="|-$indicator->getId()-|" />
		<input type="hidden" name="categoryId"  value="|-$category->getId()-|" />			
		<input type="button" value="Eliminar" onClick="javascript:indicatorsDeleteCategoryFromIndicator(this.form)" class="buttonImageDelete" />
	</form>
</li>

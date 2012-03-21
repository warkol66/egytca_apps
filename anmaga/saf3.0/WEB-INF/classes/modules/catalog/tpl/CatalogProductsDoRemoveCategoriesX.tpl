|-include file="CatalogProductCategoriesListInclude.tpl"-|
<script type="text/javascript" language="JavaScript">
  |-if $message eq "failure"-|
    $('status_info').innerHTML = "Ha ocurrido un error al intentar remover la categoría.";
    $('status_info').removeClassName("resultSuccess");
    $('status_info').addClassName("resultFailure");
  |-else if $message eq "success"-|
    $('status_info').innerHTML = "Categoría removida exitosamente.";
    $('status_info').removeClassName("resultFailure");
    $('status_info').addClassName("resultSuccess");
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
  |-/if-|
</script>
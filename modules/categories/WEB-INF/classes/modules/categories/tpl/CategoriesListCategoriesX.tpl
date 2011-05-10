<p>Categorías del módulo</p>
|-include file="CategoriesListInclude.tpl" categories=$parentUserCategories-|

|-if $newCategory neq ''-|

	<script type="text/javascript">
		var selectAdd = $('selectAddCategory');
		var selectModify = $('selectModifyCategory');
	
		var newOption1 = document.createElement('option');
		var newOption2 = document.createElement('option');
	
		var msgBox = $('systemWorking');
		msgBox.innerHTML = 'Categoría Agregada';
		msgBox.show();
	
		newOption1.value = '|-$newCategory->getId()-|'
		newOption1.innerHTML = '|-$newCategory->getName()-|';

		newOption2.value = '|-$newCategory->getId()-|'
		newOption2.innerHTML = '|-$newCategory->getName()-|';	
	
		selectAdd.options.add(newOption1);
		selectModify.options.add(newOption2);
	
	</script>
	
|-else-|
	<script type="text/javascript">
		var msgBox = $('systemWorking');
		msgBox.innerHTML = 'Se ha producido un error al agregar la categoría';
		msgBox.show();
	</script>
|-/if-|
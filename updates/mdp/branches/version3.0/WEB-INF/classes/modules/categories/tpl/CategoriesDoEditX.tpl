|-if $newCategory neq ''-|
	<li>|-$newCategory->getName()-|</li>		
	<script type="text/javascript">
		$('categoryMsgField').innerHTML = '<span class="resultSuccess">Categoría agregada</span>';

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
|-if $newCategory neq ''-|
	<li>|-$newCategory-|</li>		
	<script type="text/javascript">
		if ($('selectAddCategory') != null) {
			var optionAdd = document.createElement('option');
			optionAdd.text = '|-$newCategory-|';
			optionAdd.value = '|-$newCategory->getId()-|';
			try {
				$('selectAddCategory').add(optionAdd,null);
			}
			catch (exp) {
				$('selectAddCategory').add(optionAdd);		
			}
		}
		if ($('selectModifyCategory') != null) {
			var optionEdit = document.createElement('option');
			optionEdit.text = '|-$newCategory-|';
			optionEdit.value = '|-$newCategory->getId()-|';
			try {
				$('selectModifyCategory').add(optionEdit,null);
			}
			catch (exp) {
				$('selectModifyCategory').add(optionEdit);		
			}
		}
		$('categoryMsgField').innerHTML = '<span class="resultSuccess">Categoría agregada</span>';
	</script>
|-else-|
	<script type="text/javascript">
		$('categoryMsgField').innerHTML = '<span class="resultFailure">Se ha producido un error al agregar la categoría</span>';
	</script>
|-/if-|
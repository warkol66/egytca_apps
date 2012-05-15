|-if $newCategory neq ''-|
	<li>|-$newCategory-| ___ |-$newCategory->getResponsible()-|</li>		
	<script type="text/javascript">
		if ($('selectAddCategory') != null) {
			var optionAdd = document.createElement('option');
			optionAdd.text = '|-section name=spacesCategories start=0 loop=$newCategory->getLevel()-|\u00a0 \u00a0 |-/section-||-$newCategory-|';
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
			optionEdit.text = '|-section name=spacesCategories start=0 loop=$newCategory->getLevel()-|\u00a0 \u00a0 |-/section-||-$newCategory-|';
			optionEdit.value = '|-$newCategory->getId()-|';
			try {
				$('selectModifyCategory').add(optionEdit,null);
			}
			catch (exp) {
				$('selectModifyCategory').add(optionEdit);		
			}
		}
		$('categoryMsgField').innerHTML = '<span class="resultSuccess">Dependencia agregada</span>';
	</script>
|-else-|
	<script type="text/javascript">
		$('categoryMsgField').innerHTML = '<span class="resultFailure">Se ha producido un error al agregar la dependencia</span>';
	</script>
|-/if-|
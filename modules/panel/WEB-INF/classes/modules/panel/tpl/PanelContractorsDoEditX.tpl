<div class="successMessage">Contratista guardado correctamente</div>
<script type="text/javascript">
	$('form_edit_contractor').reset();
</script>

<script type="text/javascript" language="javascript" charset="utf-8">
	var option = document.createElement('option');
	option.text = '|-$contractor->getName()-|';
	option.value = '|-$contractor->getId()-|';
	option.id = 'contractorOption|-$contractor->getId()-|';
	
	try {
		$('contractorId').add(option,null);
	}
	catch (exp) {
		$('contractorId').add(option);		
	}
</script>

<div class="successMessage">Etiqueta guardada correctamente</div>
<script type="text/javascript">
	$('#form_edit_tag')[0].reset();
</script>

<script type="text/javascript" language="javascript" charset="utf-8">
	var option = document.createElement('option');
	option.text = '|-$blogTag->getName()-|';
	option.value = '|-$blogTag->getId()-|';
	option.id = 'regionOption|-$blogTag->getId()-|';
	
	try {
		$('tagId').add(option,null);
	}
	catch (exp) {
		$('tagId').add(option);		
	}
</script>

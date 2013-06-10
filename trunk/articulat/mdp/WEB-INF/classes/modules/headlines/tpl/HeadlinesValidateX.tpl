<script type="text/javascript" language="javascript" >
	|-if isset($existent) && $existent eq 'true'-|
	$('validate').innerHTML = '<span id="validationMessage" class="errorMessage">El título y la url del Titular ya existen. Por favor modificque alguno de los dos datos. También puede tener campos obligatorios vacíos.</span>';
	document.location.href = '#';
	|-else-|
	if(validationValidateFormClienSide($('form_edit_headline'), false)){
		$('form_edit_headline').insert('<input type="hidden" name="do" id="do" value="headlinesDoEdit" />');
		$('form_edit_headline').submit();
	}
		
	|-/if-|
</script>

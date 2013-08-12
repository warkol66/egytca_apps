<script type="text/javascript" language="javascript" >
	|-if isset($dateMessage) && $dateMessage eq 'error'-|
	$('#validate').html('<span id="validationMessage" class="errorMessage">Debe especificar fecha de inicio y fecha de finalización de la consigna.</span>');
	document.location.href = '#';
	|-elseif isset($dateMessage) && $dateMessage eq 'invalid'-|
	$('#validate').html('<span id="validationMessage" class="errorMessage">Ya existe una consigna dentro del rango de fechas definido. Por favor modifique los datos de inicio y fin de la consigna.</span>');
	document.location.href = '#';
	|-else-|
	if(validationValidateFormClienSide($('form_edit_boardChallenge'), false)){
		$('#form_edit_boardChallenge').attr('target','').append('<input type="hidden" name="do" id="doEdit" value="boardDoEdit" />').submit();
	}	
	|-/if-|
</script>

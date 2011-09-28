<script type="text/javascript" language="javascript" >
|-if !$error-|
	$('partieMsgField').innerHTML = '<span class="resultSuccess">Destinatario Agregado</span>';
|-elseif $error eq 'duplicated'-|
	$('partieMsgField').innerHTML = '<span class="resultFailure">El destinatario ya estaba asociado</span>';
|-else-|
	$('partieMsgField').innerHTML = '<span class="resultFailure">Debe seleccionar un Usuario</span>';
|-/if-|
</script>
|-include file="CommonSchedulesSubscriptionsUsersInclude.tpl"-|

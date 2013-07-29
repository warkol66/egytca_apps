<script type="text/javascript" language="javascript" >
|-if !$error-|
	$('#partieMsgField').html('<span class="resultSuccess">Destinatario Agregado</span>');
|-elseif $error eq 'duplicated'-|
	$('partieMsgField').html('<span class="resultFailure">El destinatario ya estaba asociado</span>');
|-else-|
	$('partieMsgField').html('<span class="resultFailure">Debe seleccionar un Usuario</span>');
|-/if-|
</script>
|-include file="CommonAlertsSubscriptionsUsersInclude.tpl"-|

<script type="text/javascript" language="javascript" >
|-if !$error-|
	$j('#partieMsgField').html('<span class="resultSuccess">Participante Agregado</span>');
|-elseif $error eq 'duplicated'-|
	$j('#partieMsgField').html('<span class="resultFailure">El participante ya estaba asociado</span>');
|-else-|
	$j('#partieMsgField').html('<span class="resultFailure">Debe seleccionar de Usuarios o Actores existentes</span>');
|-/if-|
</script>
|-include file="CampaignsParticipantsInclude.tpl"-|

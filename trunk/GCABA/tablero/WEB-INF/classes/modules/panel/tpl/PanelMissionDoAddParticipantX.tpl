<script type="text/javascript" language="javascript" >
|-if !$error-|
	$('partieMsgField').innerHTML = '<span class="resultSuccess">Participante Agregado</span>';
|-elseif $error eq 'duplicated'-|
	$('partieMsgField').innerHTML = '<span class="resultFailure">El participante ya estaba asociado</span>';
|-else-|
	$('partieMsgField').innerHTML = '<span class="resultFailure">Debe seleccionar de Usuarios o Actores existentes</span>';
|-/if-|
</script>
|-include file="PanelMissionParticipantsInclude.tpl"-|

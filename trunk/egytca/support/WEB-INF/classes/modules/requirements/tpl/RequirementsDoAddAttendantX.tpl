<script type="text/javascript" language="javascript" >
	$('attendantsMsgField').innerHTML = '<span class="resultSuccess">Recurso Asociado</span>';
	option = $('attendantOption|-$attendant->getAttendantid()-|');
	if (option != null) {
		Element.remove('attendantOption|-$attendant->getAttendantid()-|');
	}
</script>

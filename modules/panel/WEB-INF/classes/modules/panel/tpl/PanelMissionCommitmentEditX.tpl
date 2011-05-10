<script type="text/javascript" language="javascript" charset="utf-8">
	$('form_edit_commitment').reset();
	clearFormFieldsFormat('form_edit_commitment');

	var commitmentId = document.getElementById('commitmentId');
	commitmentId.value = "|-$commitment->getId()-|";

	var commitment = document.getElementById('commitmentData_commitment');
	commitment.value = "|-$commitment->getCommitment()|escape:'html'|strip-|";

	var responsible = document.getElementById('commitmentData_responsible');
	responsible.value = "|-$commitment->getResponsible()|escape:'html'|strip-|";

	var commitmentDate = document.getElementById('commitmentData_date');
	commitmentDate.value = "|-$commitment->getDate()|date_format-|";

	var achieved = document.getElementById('commitmentData_achieved');
	|-if $commitment->getAchieved() eq 1-|
	achieved.checked = true;
	|-else-|
	achieved.checked = false;
	|-/if-|

	$('button_edit_commitment').value = "Guardar";
	$('button_edit_commitment').title = "Guardar";

	$('commitmentInfo').innerHTML = "";

</script>

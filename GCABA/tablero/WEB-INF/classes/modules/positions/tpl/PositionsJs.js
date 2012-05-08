function addTenureToPosition(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'participantsList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('partieMsgField').innerHTML = '<span class="inProgress">agregando participante al acto...</span>';
	return true;
}

function deleteTenureToPosition(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'participantsList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	$('partieMsgField').innerHTML = '<span class="inProgress">eliminando participante...</span>';
	return true;
}

function showTenureType(type) {
	if (type == "Actor") {
		$('tenureActor').show();
		$('tenureUser').hide();
	}
	if (type == "User") {
		$('tenureActor').hide();
		$('tenureUser').show();
	}	
}

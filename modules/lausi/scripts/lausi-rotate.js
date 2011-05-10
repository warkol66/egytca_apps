function lausiProposeRotation(form,id) {

	var idDiv = 'formAdvertDiv' + id;
	var fields = Form.serialize(form);
	
	var myAjax = new Ajax.Updater(
				{success: idDiv},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	$('msgbox' + id).innerHTML = '<span class="inProgress">...Generando Propuesta...</span>';

	return true;	

}

function lausiRotateTheme(form,id) {

	var idDiv = 'formAdvertDiv' + id;
	var fields = Form.serialize(form);
	
	var myAjax = new Ajax.Updater(
				{success: idDiv},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	$('msgbox' + id).innerHTML = '<span class="inProgress">...Rotando Motivo...</span>';

	return true;	

}

function searchFormSubmit() {
	var selectAddress = $('addressId');
	if (selectAddress)
		selectAddress.selectedIndex = 0;
	$('addressMsgbox').innerHTML = '<span class="inProgress">...Cargando Direcciones...</span>';
	$('searchForm').submit();

	
}



function lausiCreateBillboardSuccess(originalRequest) {

	$('msgbox').innerHTML = '<span class="resultSuccess">Se ha creado la cartelera exitosamente</span>';
	$('addBillboardFormButton').show();
	$('addBillboardFormDiv').hide();
	Form.reset('addBillboardForm');
	
	
	return true;

}

function lausiDeleteBillboardSuccess(originalRequest) {

	$('msgbox').innerHTML = '<span class="resultSuccess">Se ha eliminado la cartelera exitosamente</span>';
	return true;
	
}

function lausiOperationFailure(originalRequest) {

	$('msgbox').innerHTML = '<span class="resultFailure">Ha ocurrido un fallo en la operación</span>';	
	
}


function lausiShowBillBoardAddForm(type) {

	if (type == "2")
		$('billboardType').innerHTML = "Sextuple";
	else
		$('billboardType').innerHTML = "Doble";
	$('type').value = type;
	$('addBillboardFormDiv').show();
	
	return true;
	
}

function lausiHideBillboardAddForm() {

	$('addBillboardFormDiv').hide();
	Form.reset('addBillboardForm');
		
	return true;
}

function lausiCreateBillboard(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'billboardList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					onComplete: lausiCreateBillboardSuccess,
					onFailure: lausiOperationFailure
				});

	$('msgbox').innerHTML = '<span class="inProgress">...Creando Cartelera...</span>';
	$('addBillboardFormDiv').hide();
	Form.reset('addBillboardForm');

	return true;	

}

function lausiDeleteBillboard(form) {


	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'billboardList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom,
					onComplete: lausiDeleteBillboardSuccess,
					onFailure: lausiOperationFailure
				});

	$('msgbox').innerHTML = '<span class="inProgress">...Eliminando Cartelera...</span>';

	return true;	

}

function setBillboardHeight(rows) {
	if (rows > 1)
		$('height').checked = true;
	else
		$('height').checked = false;
}

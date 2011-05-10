function lausiProposeOperationSuccess(originalRequest) {
	
	$('msgbox').innerHTML = '<span class="resultSuccess">La Operacion ha sido existosa.</span>';
}

function lausiProposeOperationFailure(originalRequest) {

	$('msgbox').innerHTML = '<span class="resultFailure">Ha habido un fallo en la operación.</span>';	
	
}

function lausiProposeDistribution(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'distributionProposal'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					onFailure: lausiProposeOperationFailure
				});

	


	$('msgbox').innerHTML = '<span class="inProgress">... generando propuesta de distribución ...</span>';

	return true;
	
}

function lausiDoDistribution(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgbox'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					onFailure: lausiProposeOperationFailure
				});

	


	$('msgbox').innerHTML = '<span class="inProgress">... asignando motivos...</span>';

	return true;

	
}

function lausiThemeCreationCancel(form) {

	form.reset();
	$('themeCreationDiv').hide();
	
}

function lausiThemeCreationShow() {

	$('themeCreationDiv').show();
	
}

function lausiCreationFailure() {
	
		$('msgboxCreation').innerHTML = '<span class="resultFailure">Se ha producido un error en la creación del motivo.</span>';
		
}

function lausiThemeCreationX(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgboxCreation'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					onFailure: lausiCreationFailure
				});

	$('msgboxCreation').innerHTML = '<span class="inProgress">... creando Motivo ...</span>';

	return true;
	
	
	
}

function lausiUpdateDistributeCount() {
	
	var themeId = $('themeIdSelectDistribute').value;
	var fields = 'Main.php&do=lausiThemesGetCountX&themeId=' + themeId;
	var myAjax = new Ajax.Updater(
				{success: 'themeDistributedCount'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	$('msgBoxDistributeCount').innerHTML = '<span class="inProgress">... actualizando cantidad...</span>';

	return true;
	
	
}

function lausiUpdateDistributeCountRegion() {
	
	var themeId = $('themeIdSelectDistribute').value;

	if (themeId == '')
		return false;

	var fields = 'Main.php&do=lausiThemesGetCountX&themeId=' + themeId + '&region=1';
	var myAjax = new Ajax.Updater(
				{success: 'themeDistributedCount'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	$('msgBoxDistributeCount').innerHTML = '<span class="inProgress">... actualizando cantidad...</span>';

	return true;
	
	
}

function lausiUpdateDistributeCountCircuit() {
	
	var themeId = $('themeIdSelectDistribute').value;
	
	if (themeId == '')
		return false;
	
	var fields = 'Main.php&do=lausiThemesGetCountX&themeId=' + themeId + '&circuit=1';
	var myAjax = new Ajax.Updater(
				{success: 'themeDistributedCount'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	$('msgBoxDistributeCount').innerHTML = '<span class="inProgress">... actualizando cantidad...</span>';

	return true;
	
	
}

function lausiAddAdvertOnAddress(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgBoxAddAdvert'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	$('msgBoxAddAdvert').innerHTML = '<span class="inProgress">... agregando avisos ...</span>';

	return true;
}

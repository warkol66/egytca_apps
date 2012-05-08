function tableroAddCommuneToProject(form) {
	


	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'communeList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	
	$('communeMsgField').innerHTML = '<span class="inProgress">Agregando Comuna a Proyecto...</span>';	

	
	return true;
}


function addRegionToProject(form) {
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'regionList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
				
	$('regionMsgField').innerHTML = '<span class="inProgress">agregando barrio a proyecto...</span>';
	
	return true;
}

function tableroDeleteCommuneFromProject(form){

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'communeMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				
				});
	
	$('communeMsgField').innerHTML = '<span class="inProgress">eliminando comuna de proyecto...</span>';
	
	return true;

}

function deleteRegionFromProject(form){

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'regionMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				
				});
				
	$('regionMsgField').innerHTML = '<span class="inProgress">eliminando barrio de proyecto...</span>';
	
	return true;

}

function tableroAddCommuneToObjective(form) {
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'communeList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
	
	$('communeMsgField').innerHTML = '<span class="inProgress">agregando comuna de objetivo...</span>';	

	
	return true;
}


function tableroAddRegionToObjective(form) {
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'regionList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
				
	$('regionMsgField').innerHTML = '<span class="inProgress">agregando barrio a objetivo...</span>';
	
	return true;
}

function tableroDeleteCommuneFromObjective(form){

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'communeMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				
				});
	
	$('communeMsgField').innerHTML = '<span class="inProgress">eliminando comuna de objetivo...</span>';
	
	return true;

}

function tableroDeleteRegionFromObjective(form){

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'regionMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				
				});
				
	$('regionMsgField').innerHTML = '<span class="inProgress">eliminando barrio de objetivo...</span>';
	
	return true;

}

function lausiCampaignsSearchFailure() {
	
	$('msgboxCampaigns').innerHTML = '<span class="resultFailure">Se ha producido un error</span>';
	
}

function lausiCampaignSearchSuccess() {
	
	$('msgboxCampaigns').innerHTML = '<span class="resultSuccess">La busqueda ha sido exitosa</span>';
	
}


function lausiCampaignsSearch(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'currentCampaigns'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					onFailure: lausiCampaignsSearchFailure,
					onComplete: lausiCampaignSearchSuccess
				});

	$('msgboxCampaigns').innerHTML = '<span class="inProgress">...Buscando campaña...</span>';

	return true;
		
}

function lausiCampaignsLoadDistributionWizard(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'distributionHolder'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	return true;

	
}

function lausiCampaignsDoExtension(form) {

	$('actionDoField').setValue('lausiCampaignsDoExtensionX');
	$('msgboxExtension').innerHTML = '...Extendiendo campaña...';

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgboxCampaigns'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	return true;

	
}

function lausiCampaignsDoReduction(form) {

	$('actionDoField').setValue('lausiCampaignsDoReductionX');
	$('msgboxReduction').innerHTML = '...Reduciendo campaña...';
    
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgboxCampaigns'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	return true;

	
}

function lausiCampaignsDoDelete(form) {
	
	$('msgboxDeletion').innerHTML = '<span class="inProgress">...Eliminando avisos seleccionados...</span>'
    $('actionDoField').setValue('lausiCampaignsDoDeleteX');
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgboxCampaigns'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	return true;
	
}

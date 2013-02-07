function createHidden(name,value) {

	var input = $('<input></input>').val(value).attr('name',name).hide();
	return input;
	
}

function installSkipTheStep(formId) {
	toAdd = createHidden('skip',1);
	$('#' + formId).append(toAdd).submit();
}

function installExecuteStep(formId) {
	toAdd = createHidden('stepOnly',1);
	$('#' + formId).append(toAdd).submit();
}

function installExecuteSQL(formId) {

	toAdd = createHidden('executeSQL',1);
	$('#' + formId).append(toAdd).submit();
	
}

function readOnlyCheckBox() {
   return false;
}

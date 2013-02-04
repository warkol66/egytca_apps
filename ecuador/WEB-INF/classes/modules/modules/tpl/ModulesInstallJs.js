function createHidden(name,value) {

	var input = $('<input></input>').val(value).attr('name',name).hide();
	return input;
	
}

function installSkipTheStep(form) {
	toAdd = createHidden('skip',1);
	$(form).append(toAdd).submit();
}

function installExecuteStep(form) {
	toAdd = createHidden('stepOnly',1);
	$(form).append(toAdd).submit();
}

function installExecuteSQL(form) {

	toAdd = createHidden('executeSQL',1);
	$(form).append(toAdd).submit();
	
}

function readOnlyCheckBox() {
   return false;
}

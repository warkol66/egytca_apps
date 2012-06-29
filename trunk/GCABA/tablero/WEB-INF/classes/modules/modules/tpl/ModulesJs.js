function modulesDoActivateX(form) {
	var pars = 'do=modulesDoActivateX';
	var fields = Form.serialize(form);

	var myAjax = new Ajax.Updater(
				{success: 'message'},
				url,
				{
					method: 'post',
					parameters: pars,
					postBody: fields,
					evalScripts: true
				});
		$('messageResult').innerHTML = "";
		$('messageMod').innerHTML = "<div class='inProgress'>Actualizando módulo...</div>";
}
function createHidden(name,value) {

	var input = document.createElement('input');
	input.type = 'hidden';
	input.value = value;
	input.name = name;
	return input;
	
}

function installSkipTheStep(form) {
	toAdd = createHidden('skip',1);
	form.appendChild(toAdd);
	form.submit();
}

function installExecuteStep(form) {
	toAdd = createHidden('stepOnly',1);
	form.appendChild(toAdd);
	form.submit();
}

function installExecuteSQL(form) {

	toAdd = createHidden('executeSQL',1);
	form.appendChild(toAdd);
	form.submit();
	
}

function readOnlyCheckBox() {
   return false;
}
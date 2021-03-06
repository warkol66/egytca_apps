//migrada
function modulesDoActivateX(form) {
	var pars = 'do=modulesDoActivateX';
	
	$.ajax({
		url: url,
		data: {parameters: pars, data: $('#' + form).serialize()},
		type: 'post',
		success: function(data){
			$('#message').html(data);
		}	
	});
	$('#messageResult').html("");
	$('#messageMod').html("<div class='inProgress'>Actualizando módulo...</div>");
}

//migrada
function createHidden(name,value) {

	var input = $('<input></input>').attr('type','hidden').val(value).attr('name',name);
	return input;
	
}

//migrada
function installSkipTheStep(form) {
	toAdd = createHidden('skip',1);
	$('#' + form).append(toAdd).submit();
}
//migrada
function installExecuteStep(form) {
	toAdd = createHidden('stepOnly',1);
	$('#' + form).append(toAdd).submit();
}
//migrada
function installExecuteSQL(form) {

	toAdd = createHidden('executeSQL',1);
	$('#' + form).append(toAdd).submit();
	
}

function readOnlyCheckBox() {
   return false;
}

function verifyModule(module){
	
	$('#messageResult').html("");
	$.ajax({
		url: url,
		data: $('#' + module + '_verify').serialize(),
		type: 'post',
		success: function(data){
			$('#directories_' + module).html(data);
		}	
	});
	$('#messageMod').html("<div class='inProgress'>Verificando módulo...</div>");
}

function verifyAllModules(){
	
	$('#messageResult').html("");
	$.ajax({
		url: url,
		data: $('#all').serialize(),
		type: 'post',
		success: function(data){
			eval($(data).text());
		}
	});
	$('#messageMod').html("<div class='inProgress'>Verificando módulos...</div>");
}

function updateModule(module){
	
	$('#messageResult').html("");
	$.ajax({
		url: url,
		data: $('#' + module + '_update').serialize(),
		type: 'post',
		success: function(data){
			eval($(data).text());
		}	
	});
	$('#messageMod').html("<div class='inProgress'>Actualizando módulo...</div>");
}

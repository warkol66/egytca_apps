/**
 * Efectua el formateo de formulario via javascript
 * TODO: migrar a jQuery cuando todos los sistemas dejen de usar Prototype
 */

function formatInputs(thousands,decimal,form){
	console.log(form)
	//numeric
	convertToMysqlNumericFormat(thousands,decimal);
	if(form != null)
		$(form).submit();
	//return true
}

/**
 * Efectua el formateo a tipo numerico de mySQL
 */
function convertToMysqlNumericFormat(thousands,decimal){
	var n = document.querySelectorAll(".toNumeric").length;
	for(var i = 0; i < n; i++){
		document.querySelectorAll(".toNumeric")[i].value = document.querySelectorAll(".toNumeric")[i].value.replace(thousands,'');
		document.querySelectorAll(".toNumeric")[i].value = document.querySelectorAll(".toNumeric")[i].value.replace(decimal,'.');
	}
	return true;
}

/**
 * Efectua el formateo de formulario via javascript
 * TODO: migrar a jQuery cuando todos los sistemas dejen de usar Prototype
 */

function format(){
	
	var commaT = document.querySelectorAll(".commaThousandsSeparator").length;
	var periodD = document.querySelectorAll(".periodDecimalSeparator").length;
	//en general deberian ser iguales pero chequeo por las dudas
	var n = Math.max(commaT, periodD);
	
	for(var i = 0; i < n; i++){
		if(i < commaT)
			document.querySelectorAll(".commaThousandsSeparator")[i].value = document.querySelectorAll(".commaThousandsSeparator")[i].value.replace('.','');
		if(i < periodD)
			document.querySelectorAll(".periodDecimalSeparator")[i].value = document.querySelectorAll(".periodDecimalSeparator")[i].value.replace(',','.');
	}
	return true;
	
}

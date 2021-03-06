/**
 * Efectura la validacion de formulario via javascript
 * @param Element form
 */
function validationValidateFormClienSide(form, doSubmit) {
	if (doSubmit === undefined)
		doSubmit = true;

	var valid = false;
	
	var emptyArray = document.getElementsByClassName('emptyValidation', form);
	var textArray = document.getElementsByClassName('textValidation', form);
	var mailArray = document.getElementsByClassName('mailValidation', form);
	var numericArray = document.getElementsByClassName('numericValidation', form);
	var dateArray = document.getElementsByClassName('dateValidation', form);
	var passwordMatchArray = document.getElementsByClassName('passwordMatch', form);
	
	validationClearInvalidFields(emptyArray);
	validationClearInvalidFields(mailArray);
	validationClearInvalidFields(textArray);
	validationClearInvalidFields(numericArray);
	validationClearInvalidFields(dateArray);
	validationClearInvalidFields(passwordMatchArray);

	//validaciones
	var emptyResult = validationValidateElements(emptyArray, validationEmptyValidator);
	var textResult = validationValidateElements(textArray, validationTextValidator);
	var mailResult = validationValidateElements(mailArray, validationMailValidator);
	var numericResult = validationValidateElements(numericArray, validationNumericValidator);
	var dateResult = validationValidateElements(dateArray, validationDateValidator);
	var passResult = validationValidateElements(passwordMatchArray, validationPasswordMatchValidator);

	valid = ((emptyResult.length == 0) && (textResult.length == 0) && (mailResult.length == 0) && (numericResult.length == 0) && (dateResult.length == 0) && (passResult.length == 0))

	if (valid == false) {
		validationSetInvalidFields(emptyResult,validation_messageEmpty);
		validationSetInvalidFields(textResult,validation_messageText);
		validationSetInvalidFields(mailResult,validation_messageMail);
		validationSetInvalidFields(numericResult,validation_messageNumeric);
		validationSetInvalidFields(dateResult,validation_messageDate);
		validationSetInvalidFields(passResult,validation_messagePasswordMatch);

		if (jQuery.isFunction(showValidationFailureMessage)) 
			showValidationFailureMessage(form);

		document.location.href = '#';
		return false;
	} else {
		if (jQuery.isFunction(hideValidationFailureMessage))
			hideValidationFailureMessage(form);
		if (doSubmit) 
			form.submit();
		return true;
	}
}

/**
 * Efectura la validacion de un elemento via javascript
 * @param Element id
 */
function validationValidateFieldClienSide(id) {

	var valid = false;
	var field = document.getElementById(id);
	var validationClass = field.className;
	validationClearInvalidField(field);

	switch(validationClass){
	case 'mailValidation':
		if (validationMailValidator(field) == false)
			validationSetInvalidField(field,validation_messageMail);
		break;
	case 'textValidation':
		if (validationTextValidator(field) == false)
			validationSetInvalidField(field,validation_messageText);
		break;
	case 'numericValidation':
		if (validationNumericValidator(field) == false)
			validationSetInvalidField(field,validation_messageNumeric);
		break;
	case 'dateValidation':
		if (validationDateValidator(field) == false)
			validationSetInvalidField(field,validation_messageDate);
		break;
	case 'passwordMatch':
		if (validationPasswordMatchValidator(field) == false)
			validationSetInvalidField(field,validation_messagePasswordMatch);
		break;
	case 'emptyValidation':
		if (validationEmptyValidator(field) == false)
			validationSetInvalidField(field,validation_messageEmpty);
		break;
	}
}


/**
 * Validacion de un campo a traves de su id.
 * @param String fieldId id de dom del nombre del elemento a validar.
 */
function validationValidateField(fieldId) {
	var field = document.getElementById(fieldId);

	validationClearInvalidField(field);

	if (field.hasClassName('emptyValidation')) {
		if (!(validationValidateElement(field, validationEmptyValidator)))
			validationSetInvalidField(field,validation_messageEmpty);
	}

	if (field.hasClassName('textValidation')) {
		if (!(validationValidateElement(field, validationTextValidator)))
			validationSetInvalidField(field,validation_messageText);
	}

	if (field.hasClassName('mailValidation')) {
		if (!(validationValidateElement(field, validationMailValidator)))
			validationSetInvalidField(field,validation_messageMail);
	}

	if (field.hasClassName('numericValidation')) {
		if (!(validationValidateElement(field,  validationNumericValidator)))
			validationSetInvalidField(field,validation_messageNumeric);
	}

	if (field.hasClassName('dateValidation')) {
		if (!(validationValidateElement(field, validationDateValidator)))
			validationSetInvalidField(field,validation_messageDate);
	}

	if (field.hasClassName('passwordMatch')) {
		if (!(validationValidateElement(field, validationPasswordMatchValidator)))
			validationSetInvalidField(field,validation_messagePasswordMatch);
	}

}

/**
 * Dado un cierto elemento Dom, elimina aspectos de su interfaz
 * posibles si hubieran sido validados anteriormente
 * @param Element element elemento DOM
 */
function validationClearInvalidField(element) {

	element.style.border = '';
	element.style.background = '';
	element.style.background = '#C5F1C7 url(images/valid.png) no-repeat right';
	var box = document.getElementById(element.id + '_box');
	if (box != null)
		box.innerHTML = '';

}

/**
 * Dado un conjunto de elementos Dom, elimina aspectos de su interfaz
 * posibles si hubieran sido validados anteriormente
 * @param Element element elemento DOM
 */
function validationClearInvalidFields(elements) {

	for (var i=0; i < elements.length; i++) {
		validationClearInvalidField(elements[i]);
	};

}

/**
 * Realiza las modificaciones necesarias para indicar un conjunto de
 * elementos invalidos.
 * @param Array elements array de elementos
 * @param String message mensaje de validacion para el conjunto de elementos
 */
function validationSetInvalidFields(elements,message) {

	for (var i=0; i < elements.length; i++) {
		validationSetInvalidField(elements[i],message)
	};

}

/**
 * Realiza las modificaciones necesarias para indicar un
 * elemento invalido.
 * @param Element elements elemento DOM
 * @param String message mensaje de validacion
 */
function validationSetInvalidField(element,message) {

	element.style.background = '#F4D3D3 url(images/invalid.png) no-repeat right';

	var box = document.getElementById(element.id + '_box');
	if (box != null) {

		//buscamos el del elemento correspondiente
		var fieldName = '';
		var labels = document.getElementsByTagName('label');
		var forAttr;
		for (var j=0; j < labels.length; j++) {
			forAttr = labels[j].attributes.getNamedItem('for');
			if (forAttr !== null && forAttr.value == element.id) {
				fieldName = labels[j].innerHTML;
			}
		};

		if (box.innerHTML != '') {
			//personalizacion de mensaje si se encuentra label
			box.innerHTML = box.innerHTML + ', ';
		}

		var newMessage = message.replace(/%field%/,fieldName);

		box.innerHTML = box.innerHTML + newMessage;
	}

}

/**
 * Efectua la validacion en un conjunto de elementos
 * @param Array elements
 * @param String validationFunction nombre de la funcion de validacion a utilizar.
 * @return Array array de elementos invalidos.
 */
function validationValidateElements(elements, validationFunction) {

	var valid = false;
	var processed = Array();
	var count = 0;
	for (var i=0; i < elements.length; i++) {
		valid = validationFunction(elements[i]);
		if (valid != true) {
			processed[count] = elements[i];
			count++;
		}
	};

	return processed;

}

/**
 * Efectua la validacion de un elemento DOM
 * @param String validationFunction nombre de la funcion de validacion a utilizar.
 * @return Boolean
 */
function validationValidateElement(element,validationFunction) {
	return validationFunction(element);
}

/**
 * Validador de elemento vacio
 * @param Element element elemento DOM
 */
function validationEmptyValidator(element) {

	if (element.value == '') {
		return false;
	}

	return true;
}

/**
 * Validador de elemento de texto
 * @param Element element elemento DOM
 * @return boolean
 */
function validationTextValidator(element) {

	return validateField(element, 'txt');
}

/**
 * Validador de elemento con contenido de email
 * @param Element element elemento DOM
 * @return boolean
 */
function validationMailValidator(element) {

	if (element.value == '')
		return true;

	return validateField(element, 'email');

}

/**
 * Validador de elemento numerico
 * @param Element element elemento DOM
 * @return boolean
 */
function validationNumericValidator(element) {

	if ( jQuery.isFunction(validationCustomNumericValidator) ) {
		return validationCustomNumericValidator(element);
	}
	return validateField(element, 'num');

}

/**
 * Validador de elemento fecha
 * @param Element element elemento DOM
 * @return boolean
 */
function validationDateValidator(element) {

	if ( jQuery.isFunction(validationCustomDateValidator) ) {
		return validationCustomDateValidator(element);
	}
	return validateField(element, 'date');

}

/**
 * Validador coincidencia de contraseña
 * @param Element element elemento DOM
 */
function validationPasswordMatchValidator(element) {

	var pass = document.getElementById('pass');

	if (element.value == pass.value)
		return true;

	return false;
}

/**
 * Validacion via AJAX
 * @param Element element elemento DOM a validar
 * @param String doAction nombre del action con el cual se realizara la validacion por AJAX.
 */
function validationValidateFieldThruAjax(element,doAction) {

	var url = 'Main.php?do=' + doAction;

	var actualValueName = 'actual' + element.name;

	if (document.getElementById(actualValueName) != null) {
		var actualValue = document.getElementById(actualValueName).value;
		var fields = element.name + '=' + element.value + '&actual' + element.name + '=' + actualValue;
	}
	else
		var fields = element.name + '=' + element.value;
	
	$.ajax({
		url: url,
		type: 'post',
		data: fields,
		dataType: 'json',
		success: function(data) {
			var response = data;
			console.log(response);

			document.getElementById(response.name).style.background = '#C5F1C7 url(images/valid.png) no-repeat right';

			if (response.value == 1)
				document.getElementById(response.name).style.background = '#F4D3D3 url(images/invalid.png) no-repeat right';

			var element = document.getElementById(response.name + '_box');
			if (element != null)
				element.innerHTML = response.message;

		}
	});

}

function clearFormFieldsFormat(form) {
	
	var emptyArray = document.getElementsByClassName('emptyValidation', form);
	var textArray = document.getElementsByClassName('textValidation', form);
	var mailArray = document.getElementsByClassName('mailValidation', form);
	var numericArray = document.getElementsByClassName('numericValidation', form);
	var dateArray = document.getElementsByClassName('dateValidation', form);
	var passwordMatchArray = document.getElementsByClassName('passwordMatch', form);

	clearFieldsFormat(emptyArray);
	clearFieldsFormat(mailArray);
	clearFieldsFormat(textArray);
	clearFieldsFormat(numericArray);
	clearFieldsFormat(dateArray);
	clearFieldsFormat(passwordMatchArray);

}
/**
 * Dado un cierto elemento Dom, elimina aspectos de su interfaz
 * posibles si hubieran sido validados anteriormente
 * @param Element element elemento DOM
 */
function clearFieldFormat(element) {

	element.style.border = '';
	element.style.background = '';
	var box = document.getElementById(element.id + '_box');
	if (box != null)
		box.innerHTML = '';

}

/**
 * Dado un conjunto de elementos Dom, elimina aspectos de su interfaz
 * posibles si hubieran sido validados anteriormente
 * @param Element element elemento DOM
 */
function clearFieldsFormat(elements) {

	for (var i=0; i < elements.length; i++) {
		clearFieldFormat(elements[i]);
	};

}


/**
 * Funcion para contar caracteres
 */
var TextCounter = function(textareaid, inputid, maxLength, showHide){
	if ( !(this instanceof TextCounter) )
		return new TextCounter();
	
	this.initialize(textareaid, inputid, maxLength, showHide);
};

TextCounter.prototype = {
	initialize: function(textareaid, inputid, maxLength, showHide) {
		this.maxLength = maxLength;
		this.textarea = document.getElementById(textareaid);
		this.input = document.getElementById(inputid);
		this.input.value = maxLength;
		this.input.readonly = true;
		this.input.disabled = true;
		this.input.style.display = showHide;
		$(this.textarea).bind('keyup', this, function(event) { event.data.checkChars(); });
		$(this.textarea).bind('keydown', this, function(event) { event.data.checkChars(); });
		this.checkChars();
	},
	checkChars: function(e) {
		var includeBreaksInCount = true; // false = don't count a return (\r or \n) in the count.
		var charCount = this.textarea.value.length;
		var breaks = 0;
		if (!includeBreaksInCount) {
			var lines = this.textarea.value.split('\n');
			breaks = lines.length;
			// check for /r at the end of the lines (IE)
			for (var i=0; i<lines.length; i++) {
				var line = lines[ i ];
				if (line.charCodeAt(line.length-1) == 13)
					breaks++;
			}
		}
		// check if over limit
		if ((charCount-breaks) > this.maxLength)
			this.textarea.value = this.textarea.value.substring(0, (this.maxLength + breaks) );

		// update counter
		if (this.input) {
			if ((charCount-breaks) > this.maxLength)
				this.setCountAndClass(0, "charCountLimitReached");
			else
				this.setCountAndClass((this.maxLength + breaks) - charCount, "charCount");
		}
	},
	setCountAndClass: function (count, className) {
			if (this.input.value == null)
				this.input.innerHTML = "&nbsp;" +count;
			else
				this.input.value = count;

			this.input.className = className;

	}
}

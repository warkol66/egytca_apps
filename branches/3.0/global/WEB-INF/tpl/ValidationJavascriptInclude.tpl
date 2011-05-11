<!-- libreria de validación client-side externa -->
<script language="JavaScript" type="text/javascript" src="scripts/js_validation_library.js"></script>
<!-- libreria de validación del framework-->
<script language="JavaScript" type="text/javascript" src="scripts/validation.js"></script>
<script type="text/javascript">
	var validation_messageEmpty = 'El campo &quot;%field%&quot; no puede estar vacío';
	var validation_messageText = 'El campo &quot;%field%&quot; debe contener un texto válido';
	var validation_messageMail = 'El campo &quot;%field%&quot; debe contener un mail válido';
	var validation_messageNumeric = 'El campo &quot;%field%&quot; es un número inválido';
	var validation_messageDate = 'El campo &quot;%field%&quot; tiene una fecha/formato inválido (|-$parameters.dateFormat.value-|)';
	var validation_messagePasswordMatch = 'Las contraseñas no coinciden';
</script>

<script type="text/javascript" >

	function showValidationFailureMessage(form) {
		var validationMessage = $('validationFailureMessage');
		if (!Object.isElement(validationMessage)) {
			form.insert({
				top: new Element('div', {id: 'validationFailureMessage', 'class': 'failureMessage'}).update('Tiene errores en el formulario, reviselo y vuelva a enviarlo.')
			});
		} else {
			validationMessage.show();
		}
	}

	function hideValidationFailureMessage(form) {
		var validationMessage = $('validationFailureMessage');
		if (Object.isElement(validationMessage)) {
			validationMessage.hide();
		}
	}
	
	function validationCustomNumericValidator(element) {
		var regExp = '/^[\\d]*([\\|-$parameters.thousandsSeparator-|]?[\\d]{3,3})*([\\|-$parameters.decimalSeparator-|][\\d]+)?$/';
		return validateField(element, regExp);	
	}

	function validationCustomDateValidator(element) {
		if (element.value == '')
			return true;
			
		var dateFormat = '|-$parameters.dateFormat.value-|';
		var regExp = '/^(()|(' + dateFormat + '))$/';
		regExp = regExp.gsub('d', '(0[1-9]|[12][0-9]|3[01])');
		regExp = regExp.gsub('m', '(0[1-9]|1[012])');
		regExp = regExp.gsub('y', '\\d{2,2}');
		regExp = regExp.gsub('Y', '\\d{4,4}');
		
		if ( validateField(element, regExp) ) { // si está bien formada...

			// filtramos el día.
			var dayRegExp = dateFormat.gsub(/[myY]/, '');
			dayRegExp = dayRegExp.gsub(/^(.)*-d$/, '-\\d{2,2}$');
			dayRegExp = dayRegExp.gsub(/^d(.)*$/, '^\\d{2,2}-');
			dayRegExp = dayRegExp.gsub(/^(.)*-d-(.)*$/, '-\\d{2,2}-');
			dayRegExp = new RegExp(dayRegExp);
			var day = dayRegExp.exec(element.value)[0].gsub('-', '');

			// filtramos el mes.
			var monthRegExp = dateFormat.gsub(/[dyY]/, '');
			monthRegExp = monthRegExp.gsub(/^(.)*-m$/, '-\\d{2,2}$');
			monthRegExp = monthRegExp.gsub(/^m(.)*$/, '^\\d{2,2}-');
			monthRegExp = monthRegExp.gsub(/^(.)*-m-(.)*$/, '-\\d{2,2}-');
			monthRegExp = new RegExp(monthRegExp);
			var month = monthRegExp.exec(element.value)[0].gsub('-', '');

			// filtramos el año.
			var yearRegExp = dateFormat.gsub(/[dm]/, '');
			yearRegExp = yearRegExp.gsub(/^(.)*-y$/, '-\\d{2,2}$');
			yearRegExp = yearRegExp.gsub(/^(.)*-Y$/, '-\\d{4,4}$');
			yearRegExp = yearRegExp.gsub(/^y(.)*$/, '\\^d{2,2}-');
			yearRegExp = yearRegExp.gsub(/^Y(.)*$/, '\\^d{4,4}-');
			yearRegExp = yearRegExp.gsub(/^(.)*-y-(.)*$/, '-\\d{2,2}-');
			yearRegExp = yearRegExp.gsub(/^(.)*-Y-(.)*$/, '-\\d{4,4}-');
			yearRegExp = new RegExp(yearRegExp);
			var year = yearRegExp.exec(element.value)[0].gsub('-', '');

			year = convertToFourDigits(year);

			return validateDate(parseInt(day, 10), parseInt(month, 10), parseInt(year, 10) );
		}
		return false;
	}

	function validateDate(day, month, year) {

		if ( (month > 0) && (month <= 12) ) {
			if ( (day > 0) && (day <= daysOfMonth(month, year)) ) {
				return true;
			}
		}	
		return false;
	}

	/**
	 * Determina la cantidad de días que contiene un determinado mes
	 * dependiendo también de si el año es bisiesto o no.
	 */
	function daysOfMonth(month, year) {

		// se utiliza hashing para obtener la cantidad de días en lugar de un switch.
		daysMonths = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];		
		var days = daysMonths[month - 1];

		// corrección por año bisiesto.
		if ( (month == 2) && isLeapYear(year) )
			days++;
		
		return days;	
	}

	/**
	 * Convierte un año de 2 digitos en uno de 4 que se corresponda con
	 * el siglo corriente.
	 */
	function convertToFourDigits(year) {
		if (year.lenght == 2) {
			currentYear = new Date();
			currentYear = currentYear.getFullYear();
			return currentYear.truncate(2) + year;
		}
		return year;
	}

	/**
	 * Determina si un año es bisiesto
	 */
	function isLeapYear(year) {	
		if ( (year % 400) == 0 )
	       return true;
		else if ( (year % 100) == 0 )
	       return false;
		else if ( (year % 4) == 0 )
	       return true;
		else
	       return false;
	}
</script>
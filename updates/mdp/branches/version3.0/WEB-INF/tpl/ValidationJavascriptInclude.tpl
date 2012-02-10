<!-- libreria de validación client-side externa -->
<script language="JavaScript" type="text/javascript" src="scripts/js_validation_library.js"></script>
<!-- libreria de validación del framework-->
<script language="JavaScript" type="text/javascript" src="scripts/validation.js"></script>
<script type="text/javascript">
	var validation_messageEmpty = '##common,,El campo## &quot;%field%&quot; ##common,,no puede estar vacío##';
	var validation_messageText = '##common,,El campo## &quot;%field%&quot; ##common,,debe contener un texto válido##';
	var validation_messageMail = '##common,,El campo## &quot;%field%&quot; ##common,,debe contener un mail válido##';
	var validation_messageNumeric = '##common,,El campo## &quot;%field%&quot; ##common,,es un número inválido##';
	var validation_messageDate = '##common,,El campo## &quot;%field%&quot; ##common,,tiene una fecha/formato inválido## (|-$parameters.dateFormat.value-|)';
	var validation_messagePasswordMatch = '##common,,Las contraseñas no coinciden##';
</script>

<script type="text/javascript" >
	/**
	 * Muestra los errores de validación
	 */
	function showValidationFailureMessage(form) {
		var validationMessage = $('validationMessage');
		var actionMessage = $('actionMessage');
		if (Object.isElement(actionMessage))
			actionMessage.remove();
		if (!Object.isElement(validationMessage)) {
			form.insert({
				top: new Element('div', {id: 'validationMessage', 'class': 'errorMessage'}).update('##common,,Tiene errores en el formulario, revíselo y vuelva a enviarlo.##')
			});
		}
		else
			validationMessage.toggleClassName('errorMessage').update('##common,,Tiene errores en el formulario, revíselo y vuelva a enviarlo.##').show();
	}

	/**
	 * Oculta los errores de validación
	 */
	function hideValidationFailureMessage(form) {
		var actionMessage = $('actionMessage');
		if (Object.isElement(actionMessage)) {
			actionMessage.hide();
		}
	}

	/**
	 * Valida número según segun formato del sistema
	 */
	function validationCustomNumericValidator(element) {
		var regExp = '/^[\\d]*([\\|-$parameters.thousandsSeparator-|]?[\\d]{3,3})*([\\|-$parameters.decimalSeparator-|][\\d]+)?$/';
		return validateField(element, regExp);
	}

	/**
	 * Valida la fecha segun formato del sistema
	 */
	function validationCustomDateValidator(element) {
		if (element.value == '')
			return true;

		var dateFormat = '|-$parameters.dateFormat.value-|';
		var regExp = '/^(()|(' + dateFormat + '))$/';
		regExp = regExp.gsub('d', '(0[1-9]|[12][0-9]|3[01])');
		regExp = regExp.gsub('m', '(0[1-9]|1[012])');
		regExp = regExp.gsub('y', '\\d{2,2}');
		regExp = regExp.gsub('Y', '\\d{4,4}');

		if (validateField(element, regExp)) { // si está bien formada...

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

			return validateDate(parseInt(day, 10), parseInt(month, 10), parseInt(year, 10));
		}
		return false;
	}

	/**
	 * Valida la fecha
	 */
	function validateDate(day, month, year) {

		if ((month > 0) && (month <= 12)) {
			if ((day > 0) && (day <= daysOfMonth(month, year)))
				return true;
		}
		return false;
	}

	/**
	 * Determina la cantidad de días que contiene un determinado mes
	 * dependiendo también de si el año es bisiesto o no.
	 */
	function daysOfMonth(month, year) {

		// se utiliza hashing para obtener la cantidad de días en lugar de un switch.
		var daysMonths = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		var days = daysMonths[month - 1];

		// corrección por año bisiesto.
		if ((month == 2) && isLeapYear(year))
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
		if ((year % 400) == 0)
			return true;
		else if ((year % 100) == 0)
			return false;
		else if ((year % 4) == 0)
			return true;
		else
			return false;
	}

	/**
	 * Escribe mensaje si hay campos obligatorios
	 */
	function showMandatoryFieldsMessage(form) {
		var emptyArray = document.getElementsByClassName('emptyValidation',form);
		if (emptyArray.length > 0)
			document.write('<p class="mandatoryMessage">* ##common,,Los campos indicados con borde rojo son obligatorios.##</p>');
	}

</script>
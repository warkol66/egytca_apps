function createDeliveryModeOptions(select) {
	var option = select.options[select.selectedIndex];
	
	switch (option.value) {
		//opcion de todos los dias
		case 'ED':
			createEveryDayDeliveryModeOptions();
		break;
		//opcion de una vez por semana
		case 'OW':
			createOnceAWeekDeliveryModeOptions();
		break;
		//opcion de una vez por mes
		case 'OM':
			createOnceAMonthDeliveryModeOptions();
		break;
		//opcion de unica vez
		case 'O':
			createOnceDeliveryModeOptions();
		break;
	}
}

/**
 * Crea las opciones de interfaz asocidas al modo de envio diario
 */
function createEveryDayDeliveryModeOptions() {
	var holder = $('deliveryOptions');
	holder.innerHTML = '';
	return true;
	
}

/**
 * Crea las opciones de interfaz asocidas al modo de envio diario
 */
function createOnceAWeekDeliveryModeOptions() {
	var holder = $('deliveryOptions');
	holder.innerHTML = '';
	
	var labelDaySelector = document.createElement('label');
	labelDaySelector.innerHTML = 'Día de Envío';
	var daySelector = document.createElement('select');
	daySelector.name = 'newsletterschedule[deliveryDay]';

	var days = { "Mon" : "Lunes", "Tue" : "Martes", "Wed" : "Miercoles", "Thu" : "Jueves", "Fri" : "Viernes", "Sat" : "Sabado", "Sun" : "Domingo"};
	
	for (var key in days) {
		var option = document.createElement('option');
		option.value = key;
		option.innerHTML = days[key];
		daySelector.appendChild(option);
	}
	
	holder.innerHTML = '';
	holder.appendChild(labelDaySelector);
	holder.appendChild(daySelector);
	
	return true;
	
}

/**
 * Crea un campo de ingreso de fecha con un selector de fecha
 */
function renderDeliveryDateInput(holder) {
	
	var labelDateSelector = document.createElement('label');
	labelDateSelector.innerHTML = 'Fecha de Envío';
	var dateSelector = document.createElement('input');
	dateSelector.type = 'text';
	dateSelector.name = 'newsletterschedule[deliveryDate]';
	dateSelector.size = 12;
	
	var dateSelectorDatePicker = document.createElement('img');
	dateSelectorDatePicker.src = "images/calendar.png";
	dateSelectorDatePicker.width = 16;
	dateSelectorDatePicker.height = 15;
	dateSelectorDatePicker.border = 0;
	dateSelectorDatePicker.onclick = function() {
										displayDatePicker('newsletterschedule[deliveryDate]', false, 'dmy', '-');
									};
	
	holder.innerHTML = '';
	holder.appendChild(labelDateSelector);
	holder.appendChild(dateSelector);
	holder.appendChild(dateSelectorDatePicker);
	
}

/**
 * Crea las opciones de interfaz asocidas al modo de envio diario
 */
function createOnceAMonthDeliveryModeOptions() {
	var holder = $('deliveryOptions');
	
	var labelDateSelector = document.createElement('label');
	labelDateSelector.innerHTML = 'Día de Envio';
	var dateSelector = document.createElement('input');
	dateSelector.type = 'text';
	dateSelector.name = 'newsletterschedule[deliveryDayNumber]';
	dateSelector.size = 2;
	
	holder.innerHTML = '';
	holder.appendChild(labelDateSelector);
	holder.appendChild(dateSelector);
	return true;
	
}

/**
 * Crea las opciones de interfaz asocidas al modo de envio diario
 */
function createOnceDeliveryModeOptions() {
	var holder = $('deliveryOptions');
	renderDeliveryDateInput(holder);

	return true;

	
}
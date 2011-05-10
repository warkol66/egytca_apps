
function lausiOperationSuccess(originalRequest) {
	
	$('msgbox').innerHTML = '<span class="resultSuccess">...La Operación ha sido existosa</span>';
}

function lausiOperationFailure(originalRequest) {

	$('msgbox').innerHTML = '<span class="resultFailure">...Ha ocurrido un fallo en la operación</span>';	
	
}

function lausiAddWorkforceToCircuit(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'currentWorkforcesList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom,
					onComplete: lausiOperationSuccess,
					onFailure: lausiOperationFailure
				});

	


	$('msgbox').innerHTML = '<span class="inProgress">...agregando fuerza de trabajo de circuito...</span>';

	return true;
	
}

function lausiAddCircuitToWorkforce(form) {

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'currentCircuitsList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom,
					onComplete: lausiOperationSuccess,
					onFailure: lausiOperationFailure
				});

	


	$('msgbox').innerHTML = '<span class="inProgress">...agregando circuito a fuerza de trabajo...</span>';

	return true;
	
}


function lausiDeleteWorkforceFromCircuit(form){

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgbox'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					onFailure: lausiOperationFailure
				
				});
				
	$('msgbox').innerHTML = '<span class="inProgress">...eliminando...</span>';
	
	return true;

}

//operaciones para el agregado de circutos en creacion

//
// Crea el elemento de listado
//
function lausiCreateAddElement(id,name) {

		listElement = document.createElement('li');
		listElement.id = 'circuit' + id;
		listElement.value = id;

		text = document.createElement('label');
		text.id = 'circuitName' + id;
		text.innerHTML = name;
		
		var button = document.createElement('input');
		button.type = 'button';
		button.setAttribute('class','buttonImageDelete');
		button.setAttribute('onClick','javascript:lausiDeleteCircuitFromWorkforceAtCreate(' + id + ')');
		
		listElement.appendChild(text);
		listElement.appendChild(button);
			
		return listElement;
			
}

//
// Crea el elemento de opcion al select para agregado de circuitos
//
function lausiCreateOptionElement(id,name) {

	option = document.createElement('option');
	option.value = id;
	option.innerHTML = name;

	return option;
	
}

//
// Agrega el circuito al form 
//
function lausiAddCircuitToForm(id) {
	
	field = document.createElement('input');
	field.type = 'hidden';
	field.name = 'circuits[' + id + ']';
	field.value = id;
	field.id = 'createAdd' + id;
	
	$('form_edit_workforce').appendChild(field);
	
}


//
// Quita el circuit del form
//
function lausiDeleteCircuitFromForm(id) {
	
	label = 'createAdd' + id;
	$(label).remove();
	
}

//
// Hace las actualizaciones en la vista correspondientes al agregado de un circuito en creacion
//
function lausiAddCircuitToWorkforceAtCreate() {
	
	elements = $('circuitAdder').getElementsByTagName('select');
	optionsList = elements[0];
	
	id = optionsList[optionsList.selectedIndex].value;
	name = optionsList[optionsList.selectedIndex].innerHTML;
	
	//agregamos el elemento al formulario
	lausiAddCircuitToForm(id);
	
	//creamos el elemento visual
	listItem = lausiCreateAddElement(id,name);
	
	$('currentCircuitsList').appendChild(listItem);	
	optionsList[optionsList.selectedIndex].remove();

	
}

//
// Hace las actualizaciones correspondientes a la eliminacion de un circuito en creacion
//
function lausiDeleteCircuitFromWorkforceAtCreate(id) {

	//eliminamos el elemento del form
	lausiDeleteCircuitFromForm(id);
	
	name = $('circuitName' + id).innerHTML;

	option = lausiCreateOptionElement(id,name);
	optionsList = $('circuitAdder').getElementsByTagName('select');
	optionsList = elements[0];
	
	optionsList.appendChild(option);
	
	//eliminamos el elemento grafico
	$('circuit'+id).remove();
}

//
// Cambia el estado de un motivo
//
function lausiThemeActiveToggle(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgbox_'+(form['themeId']).getValue()},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	


	$('msgbox_'+(form['themeId']).getValue()).innerHTML = '<span class="inProgress">...Cambiando estado del motivo...</span>';

	return true;
}

//
// Pasa a inactivos todos los motivos vencidos
//
function lausiThemesDeactivateEnded(form) {
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'msgboxDeactivate'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});

	


	$('msgboxDeactivate').innerHTML = '<span class="inProgress">...Desactivando motivos...</span>';

	return false;
}


function setSelectionBillboards(mode) {
	
	
	var checkboxes = document.getElementsByName('toDelete[]');
	var i;
	for (i=0;i<checkboxes.length; i++)
		checkboxes[i].checked = mode;
		
	return true;
	
	
}

function deleteSelectedBillboards() {
	
	var value = confirm('Seguro que desea eliminar las carteleras seleccionadas?');
	if (value == false)
		return false;
	
	var checkboxes = document.getElementsByName('toDelete[]');
	var form = $('selectedDeletionForm');
	
	var i;
	for (i=0;i<checkboxes.length; i++) {
		
		if (checkboxes[i].checked == true) {
			
			var hidden = document.createElement('input');
			hidden.setAttribute('type','hidden');
			hidden.setAttribute('name',checkboxes[i].name);
			hidden.setAttribute('value',checkboxes[i].value);
			form.appendChild(hidden);
		}
	
	}
	
	form.submit();
	
	return true;
	
	
	
}
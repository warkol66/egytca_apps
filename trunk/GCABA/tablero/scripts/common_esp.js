function setClass(id,clase) {
	var element = document.getElementById(id);
	element.className=clase;
}
function logout(){
	return window.confirm("Esta seguro que quiere salir del sistema?")
}
function clearForm(oForm) {

	var elements = oForm.elements;
	oForm.reset();
	for(i=0; i<elements.length; i++) {

		field_type = elements[i].type;
		switch(field_type) {

			case "text":
			case "password":
			case "textarea":

				elements[i].value = "";
				break;

			case "radio":
			case "checkbox":
					if (elements[i].checked)
						elements[i].checked = false;
				break;

			case "select-one":
			case "select-multi":
									elements[i].selectedIndex = 0;
				break;

			default:
				break;
		}
	}
}

<!-- Script usado para hacer un checkbox masivo -->

<!-- Begin
var checkflag = "false";
function check(field) {
	if (checkflag == "false") {
		for (i = 0; i < field.length; i++) {
			field[i].checked = true;
		}
		checkflag = "true";
		return "Deseleccionar Todos";
	}
	else{
		for (i = 0; i < field.length; i++){
			field[i].checked = false;
		}
		checkflag = "false";
		return "Seleccionar Todos";
	}
}
//  End -->

function switch_vis(element,display){
	var e_ref="";
	var ant="";
	e_ref=document.getElementById(element);
	if (display == undefined){
		display='block';
	}
	ant=e_ref.style.display;
	if (e_ref.style.display !=  'none' && e_ref.style.display != ""){
		display='none';
	}
	else{
		display=display;
	}
	e_ref.style.display=display;
}

function switch_vis_mult(elements) {
	var i=0;
	for(i=0; i<elements.length; i++){
		switch_vis(elements[i],'none');
	}
}

function elementShow(element){
	var e_ref="";
	var display="block";
	e_ref=document.getElementById(element);
	e_ref.style.display=display;
}

function switch_value(element,value){
	var e_ref="";
	var ant="";
	e_ref=document.getElementById(element);
	if (value == undefined){
		value='Mostrar Sección';
	}
	ant=e_ref.value;
	if (e_ref.value !=  'Ocultar Sección' && e_ref.value != ""){
		value='Ocultar Sección';
	}
	else{
		value=value;
	}
	e_ref.value=value;
}

var myGlobalHandlers = {
	onCreate: function(){
		Element.show('systemWorking');
	},
	onFailure: function(){
		alert('Sorry. There was an error.');
	},
	onComplete: function() {
		if(Ajax.activeRequestCount == 0){
			Element.hide('systemWorking');
		}
	}
};

Ajax.Responders.register(myGlobalHandlers);

function categoriesDoEditX() {
	var pars = 'do=categoriesDoEditX';
	var fields = Form.serialize('form_category_add');

	var myAjax = new Ajax.Updater(
				{success: 'table_categories_list'},
				url,
				{
					method: 'post',
					parameters: pars,
					postBody: fields,
					insertion: Insertion.Bottom
				});
	$('name').value = "";
}

function CheckAllBoxes(fmobj) {
  for (var i=0;i<fmobj.elements.length;i++) {
    var e = fmobj.elements[i];
    if ( (e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled) ) {
      e.checked = fmobj.allbox.checked;
    }
  }
}
function printFunction() {
	self.print();
	window.close();
}

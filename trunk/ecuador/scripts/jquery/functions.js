function setClass(elementId,className) {
	var element = document.getElementById(elementId);
	element.className = className;
} // End of setClass

function setClassMultiple(elements,className){
	var i=0;
	for(i=0; i<elements.length; i++){
		setClass(elements[i],className);
	}
} // End of setClassMultiple

function setElementClass(elementId,className) {
	var element = document.getElementById(elementId);
	element.className = className;
} // End of setElementClass

function switchDisplay(element,display){
	var element_ref = "";
	var undefinedDisplayValue = 0;
	var switchDisplayValue = "";
	element_ref = document.getElementById(element);
	if (display == undefined){
		undefinedDisplayValue = 1;
	}
	if (element_ref.style.display != 'none' && element_ref.style.display != "" && display == undefined){
		display = 'none';
	}
	else{
		if (undefinedDisplayValue == 1 && switchDisplayValue != display) {
			display = switchDisplayValue;
		}
	}
	element_ref.style.display=display;
} // End of switchDisplay

function switchDisplayMultiple(elements,display){
	if (display == undefined){
		switchDisplayValue = 'none';
	}
	var i=0;
	for(i=0; i<elements.length; i++){
		switchDisplay(elements[i],display);
	}
} // End of switchDisplayMultiple

function logout(){
	return window.confirm("Esta seguro que quiere salir del sistema?")
} // End of logout

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
} // End of clearForm

function CheckAllBoxes(fmobj) {
  for (var i=0;i<fmobj.elements.length;i++) {
    var e = fmobj.elements[i];
    if ( (e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled) ) {
      e.checked = fmobj.allbox.checked;
    }
  }
} // End of CheckAllBoxes

function checkBoxesByName(boxesName) {  
  var allbox = document.getElementById('allbox');
  var arr = new Array();
  arr = document.getElementsByName(boxesName); 
  for(var i = 0; i < arr.length; i++) {
    var e = document.getElementsByName(boxesName).item(i);
    if ( (e.id != 'allbox') && (e.type=='checkbox') && (!e.disabled) ) {
      e.checked = allbox.checked;
    }
  }
} // End of checkBoxesByName

//migrada
function switch_vis(element,display) {
	var e_ref = $('#' + element);
	var ant = e_ref.css('display');
	if(display == undefined)
		display = 'block';
	if (ant !=  'none' && ant != "") {
		display='none';
	}
	else {
		display=display;
	}
	e_ref.css('display',display);
} // End of switch_vis

function switch_vis_mult(elements) {
	var i=0;
	for(i=0; i<elements.length; i++) {
		switch_vis(elements[i],'none');
	}
} // End of switch_vis_mult

function switch_class_mult(elements,className) {
	var i=0;
	for(i=0; i<elements.length; i++){
		setClass(elements[i],className);
	}
} // End of switch_class_mult

function elementShow(element){
	var e_ref="";
	var display="block";
	e_ref=document.getElementById(element);
	e_ref.style.display=display;
} // End of elementShow

function switch_value(element,value) {
	var e_ref="";
	var ant="";
	e_ref=document.getElementById(element);
	if (value == undefined)	{
		value='Mostrar Sección';
	}
	ant=e_ref.value;
	if (e_ref.value !=  'Ocultar Sección' && e_ref.value != "")	{
		value='Ocultar Sección';
	}
	else {
		value=value;
	}
	e_ref.value=value;
} // End of switch_value

function addConfigAttribute(li) {
	ul = document.getElementById(li.id+"_ul");
	newName=window.prompt("Nombre del nuevo atributo:",'');
	ul.innerHTML += "<li>"+newName+": <input type='text' name='"+li.id+"["+newName+"]' value='' />"+
		'<a class="configIcon" href="#" onclick="javascript:deleteConfigAttribute(this.parentNode); return false;">'+
		'<img src="images/delete-comment-blue.gif" alt="Eliminar" /></a></li>';
	return false;
} // End of addConfigAttribute

function addConfigSection(li) {
	ul = document.getElementById(li.id+"_ul");
	newName=window.prompt("Nombre de la nueva sección:",'');
	ul.innerHTML += "<li id='"+li.id+"["+newName+"]'>"+newName+
		' <a class="configIcon" href="#" onclick="javascript:addConfigAttribute(this.parentNode); return false;"><img src="images/add-comment-blue.gif" alt="Agregar Atributo" title="Agregar Atributo" /></a>'+
		' <a class="configIcon" href="#" onclick="javascript:addConfigSection(this.parentNode); return false;"><img src="images/add-folder-green.gif" alt="Agregar Secci&oacute;n" title="Agregar Secci&oacute;n" /></a>'+
		' <a class="configIcon" href="#" onclick="javascript:deleteConfigAttribute(this.parentNode); return false;">'+
		'<img src="images/delete-folder-green.gif" alt="Eliminar" /></a>'+
		"<ul id='"+li.id+"["+newName+"]_ul'></ul></li>";
} // End of addConfigSection

function deleteConfigAttribute(li) {
	ul = li.parentNode;
	ul.removeChild(li);
	return false;
} // End of deleteConfigAttribute

function printFunction() {
	self.print();
	window.close();
} // End of printFunction

function ordersSendOrdersExport(form) {
	document.getElementById('do').value = "ordersExport";
	form.submit();
	return true;
} // End of ordersSendOrdersExport

function ordersSendOrdersDelete(form) {
	document.getElementById('do').value = "ordersDoDelete";
	form.submit();
	return true;
} // End of ordersSendOrdersExport

function ordersSendOrdersExportSaf(form) {
	
	document.getElementById('doActions').value = "ordersExportSaf";
	form.submit();
	
	return true;
} // End of ordersSendOrdersExportSaf

<!-- End of Orders -->




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

function cambiaclase(element,clase) {
	var NAME = document.getElementById(element);
	NAME.className=clase;
} // End of cambiaclase


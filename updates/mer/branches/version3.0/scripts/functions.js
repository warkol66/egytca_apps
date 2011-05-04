function cambiaclase(element,clase) {
	var NAME = document.getElementById(element);
	NAME.className=clase;
}
		function logout(){
			return window.confirm("Esta seguro que quiere salir del sistema?")
		}

<!-- Script usado para hacer un checkbox masivo -->

<!-- Begin
var checkflag = "false";
function check(field) {
if (checkflag == "false") {
for (i = 0; i < field.length; i++) {
field[i].checked = true;}
checkflag = "true";
return "Deseleccionar Todos"; }
else {
for (i = 0; i < field.length; i++) {
field[i].checked = false; }
checkflag = "false";
return "Seleccionar Todos"; }
}
//  End -->


function addConfigAttribute(li) {
	ul = document.getElementById(li.id+"_ul");
	newName=window.prompt("Nombre del nuevo atributo:",'');
	ul.innerHTML += "<li>"+newName+": <input type='text' name='"+li.id+"["+newName+"]' value='' />"+
		'<a class="a_image" href="#" onclick="javascript:deleteConfigAttribute(this.parentNode)">'+
		'<img src="images/delete-comment-blue.gif" alt="Eliminar" /></a></li>';
}

function addConfigSection(li) {
	ul = document.getElementById(li.id+"_ul");
	newName=window.prompt("Nombre de la nueva seccion:",'');
	ul.innerHTML += "<li id='"+li.id+"["+newName+"]'>"+newName+
		' <a class="a_image" href="#" onclick="javascript:addConfigAttribute(this.parentNode)"><img src="images/add-comment-blue.gif" alt="Agregar Atributo" title="Agregar Atributo" /></a>'+
		' <a class="a_image" href="#" onclick="javascript:addConfigSection(this.parentNode)"><img src="images/add-folder-green.gif" alt="Agregar Secci&oacute;n" title="Agregar Secci&oacute;n" /></a>'+
		' <a class="a_image" href="#" onclick="javascript:deleteConfigAttribute(this.parentNode)">'+
		'<img src="images/delete-folder-green.gif" alt="Eliminar" /></a>'+
		"<ul id='"+li.id+"["+newName+"]_ul'></ul></li>";
}

function deleteConfigAttribute(li) {
	ul = li.parentNode;
	ul.removeChild(li);
}

function showOptionsGraph(select) {
	switch (select.value) {
		case "plot_bubble":
			document.getElementById("div_plot_bubble").style.display = "block";
			document.getElementById("div_plot").style.display = "block";
      document.getElementById("div_select_questions").style.display = "none";
			break
		case "plot":
			document.getElementById("div_plot").style.display = "block";
      document.getElementById("div_select_questions").style.display = "none";
      document.getElementById("div_plot_bubble").style.display = "none";
      break;
		case "pie":
		case "infography":
			document.getElementById("div_plot").style.display = "none";
      document.getElementById("div_select_questions").style.display = "block";
			document.getElementById("div_plot_bubble").style.display = "none";      
      break;
	}
}

function changeNameGraphRelation(form) {
	var actualName = form.graphName.value;
	var newName;
	if (newName == window.prompt("Nombre del grafico:",actualName)) {
		form.graphName.value = newName;
		return true;
	}
	return false;
}

function switch_vis(element,display)
{
	var e_ref="";
	var ant="";
	e_ref=document.getElementById(element);
	if (display == undefined)
	{
		display='block';
	}
	ant=e_ref.style.display;
	if (e_ref.style.display !=  'none' && e_ref.style.display != "")
	{
		display='none';
	}
	else
	{
		display=display;
	}
	e_ref.style.display=display;
}
function switch_value(element,value)
{
	var e_ref="";
	var ant="";
	e_ref=document.getElementById(element);
	if (value == undefined)
	{
		value='Mostrar Sección';
	}
	ant=e_ref.value;
	if (e_ref.value !=  'Ocultar Sección' && e_ref.value != "")
	{
		value='Ocultar Sección';
	}
	else
	{
		value=value;
	}
	e_ref.value=value;
}
function switch_vis_mult(elements)
{
	var i=0;
	for(i=0; i<elements.length; i++)
	{
		switch_vis(elements[i],'none');
	}
}
function printFunction()
{
	self.print();
	window.close();
}

function selectAllQuestions(checked) {
	var questions = document.formQuestions.elements['applyableQuestions[]'];
	for (var i = 0; i < questions.length; i++) {
		questions[i].checked = checked;
	}
}

function showGraphNetwork(urlActors) {
  window.frame_graph.document.getElementById('span_loading').style.display = 'inline';
	var questions = document.forms.form_questions.elements['questions[]'];
	var categoryId = document.forms.form_questions.elements['categoryId'].value;
	var formId = document.forms.form_questions.elements['form'].value;
	var questionsId = "";
	for (var i=0; i<questions.length; i++) {
		var question = questions[i];
		var questionId = question.value;
		if (question.checked)
			questionsId += "&questions[]="+questionId;
 	}
 	var url = "Main.php?do=analysisGraphNetworkShow"+urlActors+"&form="+formId+questionsId;
 	window.frame_graph.location.href = url;
}


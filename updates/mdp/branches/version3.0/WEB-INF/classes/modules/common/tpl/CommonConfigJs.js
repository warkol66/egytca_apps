function addConfigAttribute(li) {
	ul = document.getElementById(li.id+"_ul");
	newName=window.prompt("Nombre del nuevo atributo:",'');
	ul.innerHTML += "<li>"+newName+": <input type='text' name='"+li.id+"["+newName+"]' value='' />"+
		'<a href="#" onclick="javascript:deleteConfigAttribute(this.parentNode)"><img src="images/delete-comment-blue.gif" class="configLinkImage" alt="Eliminar" title="Eliminar" /></a></li>';
}

function addConfigSection(li) {
	ul = document.getElementById(li.id+"_ul");
	newName=window.prompt("Nombre de la nueva sección:",'');
	ul.innerHTML += "<li id='"+li.id+"["+newName+"]'>"+newName+
		' <a href="#" onclick="javascript:addConfigAttribute(this.parentNode)"><img src="images/add-comment-blue.gif" class="configLinkImage" alt="Agregar Atributo" title="Agregar Atributo" /></a>'+
		' <a href="#" onclick="javascript:addConfigSection(this.parentNode)"><img src="images/add-folder-green.gif" class="configLinkImage" alt="Agregar Sección" title="Agregar Sección" /></a>'+
		' <a href="#" onclick="javascript:deleteConfigAttribute(this.parentNode)"><img src="images/delete-folder-green.gif" class="configLinkImage" alt="Eliminar" title="Eliminar" /></a>'+
		"<ul id='"+li.id+"["+newName+"]_ul'></ul></li>";
}

function deleteConfigAttribute(li) {
	ul = li.parentNode;
	ul.removeChild(li);
}

<script type="text/javascript">
	newItem = document.createElement('li');
	newItem.id = 'answerOption|-$answerOption->getId()-|';
	newItem.innerHTML = '|-$answerOption->getAnswer()-| ';
	
	form = document.createElement('form');
	form.method = 'post';
	
	doInput = document.createElement('input');
	doInput.type = 'hidden';
	doInput.name = 'do';
	doInput.value = 'surveysAnswerOptionsDeleteX';
	form.appendChild(doInput);

	idInput = document.createElement('input');
	idInput.type = 'hidden';
	idInput.name = 'answerOptionId';
	idInput.value = '|-$answerOption->getId()-|';
	form.appendChild(idInput);
	
	button = document.createElement('input');
	button.addClassName('iconDelete');
	button.type = 'button';
	button.name = 'eliminar';
	button.value = 'eliminar';
	button.setAttribute('onClick','javascript:deleteAnswerOptionX(this.form)');
	form.appendChild(button);	
	
	newItem.appendChild(form);
	
	$('surveyQuestionOptionsList').appendChild(newItem);
	$('surveyQuestionOptionsAddForm').reset();
	
</script>

Opcion de Respuesta Agregada con Exito.
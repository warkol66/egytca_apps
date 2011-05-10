<script type="text/javascript" language="javascript">

	if ($('currentWorkforceListItem|-$workforce->getId()-|') != null) {
	
		$('currentWorkforceListItem|-$workforce->getId()-|').remove();

		//creo el elemento de la lista de opciones para que pueda volver a ser agregado
		var option = document.createElement('option');
		option.id = 'workforce|-$workforce->getId()-|';
		option.value = '|-$workforce->getId()-|';
		option.innerHTML = '|-$workforce->getName()-|';
		//lo agrego a la lista de opciones
		elements = $('workforceAdder').getElementsByTagName('select');
		elements[0].appendChild(option);
		
		$('msgbox').innerHTML = 'La operacion ha sido exitosa.';
		
	}

</script>

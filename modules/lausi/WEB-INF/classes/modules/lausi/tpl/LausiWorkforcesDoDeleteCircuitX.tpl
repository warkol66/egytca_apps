<script type="text/javascript" language="javascript">

	if ($('currentCircuitListItem|-$circuit->getId()-|') != null) {
	
		$('currentCircuitListItem|-$circuit->getId()-|').remove();

		//creo el elemento de la lista de opciones para que pueda volver a ser agregado
		var option = document.createElement('option');
		option.id = 'circuit|-$circuit->getId()-|';
		option.value = '|-$circuit->getId()-|';
		option.innerHTML = '|-$circuit->getName()-|';
		//lo agrego a la lista de opciones
		elements = $('circuitAdder').getElementsByTagName('select');
		elements[0].appendChild(option);
		
		$('msgbox').innerHTML = 'La operacion ha sido exitosa.';
		
	}

</script>

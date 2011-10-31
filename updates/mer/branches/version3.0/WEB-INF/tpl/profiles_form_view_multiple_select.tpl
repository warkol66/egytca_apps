<script>
	function checkSelectedActorCount(input) {
		var count = 0;
		for (var i=0;i<document.selectActors.elements.length;i++)
			if (document.selectActors.elements[i].checked)
				count++;
		if (count > |-$maxActors-|) {
			alert("Solo puede seleccionar |-$maxActors-| actores!");
			input.checked = false;
			return false;
		}
		return true;
	}
</script>
 <h2>Comparación de Ciudades</h2> 
			<h1>Comparar Ciudades </h1> 
		<p>En este módulo podrá seleccionar varias ciudades para comparar sus datos en un cuadro comparativo. Seleccione a continuación las ciudades a comparar. </p> 
|-include file="actors_include_select_multiple.tpl" do="profilesFormViewMultiple" select="profilesFormViewMultipleSelect"-|


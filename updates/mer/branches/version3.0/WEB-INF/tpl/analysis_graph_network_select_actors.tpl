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
 <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
	<tbody> 
		<tr> 
			<td class="titulo">Comparación de Ciudades</td> 
		</tr> 
		<tr> 
			<td class="subrayatitulo"><img src="index.php_files/clear.gif" height="3" width="1"></td> 
		</tr> 
		<tr> 
			<td>&nbsp;</td> 
		</tr> 
		<tr> 
			<td class="fondotitulo">Comparar Ciudades </td> 
		</tr> 
		 <tr> 
			<td>&nbsp;</td> 
		</tr> 
		 <tr> 
			<td class="texto">En este módulo podrá seleccionar varias ciudades para comparar sus datos en un cuadro comparativo. Seleccione a continuaci&oacute;n las ciudades a comparar. </td> 
		</tr> 
		 <tr> 
			<td>&nbsp;</td> 
		</tr> 
	 </tbody> 
</table> 
|-include file="actors_include_select_multiple.tpl" do="analysisGraphNetwork" select="analysisGraphNetworkSelectActors"-|

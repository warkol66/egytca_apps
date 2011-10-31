<form method="get" action="Main.php"> 
	<input type="hidden" name="do" value="actorSelect" /> 
	<input type="hidden" name="successAction" value="|-$successAction-|" /> 
	<table class="tableTdBorders" border="0" cellpadding="3" cellspacing="1" width="100%"> 
		<tr> 
			<td class="celltitulo2" nowrap="nowrap" width="35%">##103,Seleccione una categoría##</td> 
			<td class="celldato"><input name="modulo" value="contacto" type="hidden"> 
				<select name="catID" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" > 
						|-html_options options=$categories-|
					<option value="" selected="selected">##103,Seleccione una categoría##</option> 
				</select> </td> 
		</tr> 
		<tr> 
			<td class="cellboton" colspan="2"><input value="##120,Continuar##" type="submit"> 
&nbsp;&nbsp; 
				<input onclick="history.go(-1)" value="##104,Regresar##" type="button"></td> 
		</tr> 
	</table> 
</form>

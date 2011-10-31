|-if $actors|count eq 0-|
<table class='tableTdBorders' cellspacing='0' cellpadding='0' border='0' width='100%'>
	<tbody> 
		<tr>
			<td nowrap="nowrap" width="35%" class="tdTitle2"><div class="textTitle2">Todos las ciudades de la categoría:</div></td> 
			<td width="65%"><form method="get" action="Main.php" style="display:inline;"> 
					<input type="hidden" name="do" value="|-$do-|" /> 
					<select name="categoryId" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" > 
								|-html_options options=$categories-|
						<option value="" selected="selected">Seleccione la categoría</option> 
					</select> 
			</form></td> 
		</tr> 
		<tr>
			<td colspan="2" class="celldato">&nbsp;</td>
		</tr>
		<tr> 
			<td nowrap="nowrap" width="35%" class="tdTitle2"><div class="textTitle2">Algunas Ciudades de la categoría:</div></td>
			<td width="65%"> <form method="get" action="Main.php" style="display:inline;"> 
					<input type="hidden" name="do" value="|-$select-|" /> 
					<select name="categoryId" onchange="if (this.options[this.selectedIndex].value) this.form.submit()" > 
								|-html_options options=$categories-|
						<option value="" selected="selected">Seleccione la categoría</option> 
					</select> 
			</form></td> 
		</tr> 
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr> 
			<td nowrap="nowrap" width="35%" class="tdTitle2"><div class="textTitle2">Seleccionar Ciudades de todas las categorías</div></td>
			<td width="65%"> <form method="get" action="Main.php" style="display:inline;"> 
					<input type="hidden" name="do" value="|-$select-|" />
					<input type="hidden" name="alls" value="1" /> 
					<input type="submit" value="Listar ciudades" /> 
				</form></td> 
		</tr> 
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr> 
			<td class="tdButton" colspan="2"><input onclick="history.go(-1)" value="Regresar" type="button"></td> 
		</tr> 
	</tbody> 
</table> 
|-else-|

<table border="0" cellpadding="0" cellspacing="0" width="100%"> 
		 <tr> 
			<td class="texto">Seleccione las ciudades a comparar y haga click en "Comparar" para ver los datos de las Ciudades. <br>
			 Puede seleccionar hasta |-$maxActors-| Ciudades a comparar.</td> 
		</tr> 
		 <tr> 
			<td>&nbsp;</td> 
		</tr> 
</table>
<form method="get" action="Main.php" style="display:inline;" id="selectActors" name="selectActors"> 
	<input type="hidden" name="do" value="|-$do-|" />
<table class='tableTdBorders' cellspacing='0' cellpadding='0' border='0' align='center' width='80%'>
		<tr> 
			<th width="95%"><div class='textTitleTh'>Ciudad</div></th> 
			<th width="5%"><div class='textTitleTh'>&nbsp;</div></th> 
		</tr> 
		|-foreach from=$actors item=actor-|
		<tr> 
			<td width="90%" class='tdTextTitle'>|-$actor->getName()-|</td> 
			<td><input type="checkbox" name="actors[]" value="|-$actor->getId()-|" onclick="javascript:checkSelectedActorCount(this)" /></td> 
		</tr> 
		|-/foreach-|
		<tr> 
			<td class="tdButton" colspan="2"><input value="Comparar" type="submit"> &nbsp;&nbsp;&nbsp;<input onclick="history.go(-1)" value="Regresar" type="button"></td> 
		</tr> 
	</table> 
</form> 
|-/if-|

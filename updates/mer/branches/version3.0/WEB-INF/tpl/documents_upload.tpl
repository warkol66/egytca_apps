<table width="100%" border="0" cellspacing="0" cellpadding="5">
	<form method="post" enctype="multipart/form-data" action="Main.php?do=documentsDoUpload">
	<table width="100%" border="0" cellpadding="4" cellspacing="1">
		<tr> 
			<th colspan="2" class="thresultado">
				<span class="style3">Agregar Nuevo Documento</span>
			</th>
        </tr>
        <tr>
            <td colspan="2" class="size2">Ingrese los datos correspondientes para su nuevo documento&quot;.
				|-if $msg eq "wrongPasswordComparison"-|
					<br><br><b>Error: Las contraseñas ingresadas no concuerdan</b><br>
					|-elseif $msg eq "wrongCategory" -|
					<br><br><b>Error: Debe seleccionar un tipo de documento</b><br>
				|-/if-|
			</td>
        </tr>
        <tr class="row_even"> 
             <td width="23%" class="style6">Archivo:&nbsp;</td>
             <td width="77%"><input name="documento" type="file" size="35"  class="TXTnormal"></td>
        </tr>
        <tr class="row_even"> 
              <td nowrap class="style6">Tipo de documento:&nbsp;</td>
              <td>
					<select name="category" size="1"  class="TXTnormal">            
					<option value='0'>Seleccione el Tipo</option>
 					|-foreach from=$categories item=category-| 
						<option value="|-$category->getId()-|" |-if $category->getId() eq $docscategory-|selected="selected"|-/if-|>|-$category->getName()-|</option>
					|-/foreach-|
					</select>
			  </td>
         </tr>
         <tr class="row_even"> 
              <td nowrap class="style6">Fecha :&nbsp;</td>
              <td> 
				<input name="date" type="text" value="|-$date-|" size="10">
              </td>
         </tr>
         <tr class="row_even"> 
			<td class="style6">Descripci&oacute;n:&nbsp;</td>
            <td><textarea name="description" cols="40" rows="7" wrap="VIRTUAL"  class="TXTnormal"></textarea></td>
         </tr>
		 <tr class="row_even"> 
            <td class="style6">Contraseña:</td>
            <td>   <input name="password" type="password" size="10"></td>
         </tr>
		 <tr class="row_even"> 
            <td class="style6">Repita Contraseña:</td>
            <td>   <input name="password_compare" type="password" size="10"></td>
         </tr>
         <tr align="right"> 
            <td colspan="2"> <input name="upload" type="submit" class="botonchico" value="Agregar Documento"> 
            </td>
         </tr>
    </table>
    </form>    
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="5">
 <tr>
    <th class="thresultado"><div align="center" class="style3">Editar Documento</div></th>
 </tr>
    <form method="post" action="Main.php?do=doEditFile">
	<table width="100%" border="0" cellpadding="4" cellspacing="1">
    <tr>
      <input type="hidden" value="|-$document->getId()-|" name="id">
       <td colspan="2" class="size2">Ingrese los datos del documento 
                    a editar y haga click en &quot;Editar Documento&quot;.<br>
                    Puede cambiar los datos que se muestran a contimnuaci&oacute;n, 
                    si desea modificar el archivo, primero elim&iacute;nelo y 
                    s&uacute;balo nuevamente. Los documentos tipo &quot;Estado 
                    de Cuenta&quot; Solo pueden ser vistos por el Concesionario 
                    asignado&quot;.
		</td>
     </tr>
     <tr class="row_even"> 
         <td nowrap class="style6">Fecha :&nbsp;</td>
         <td> 
             <input name="document_date" type="text" value="|-$document->getDocumentDate()-|" size="10">
          </td>
      </tr>
	  <tr class="row_even"> 
         <td nowrap class="style6">Tipo de documento:&nbsp;</td>
         <td> 
		    <select name="category" size="1"  class="TXTnormal">            
			<option value='0'>Seleccione el Tipo</option>
 			|-foreach from=$categories item=category-| 
			<option value="|-$category->getId()-|" |-if $category->getId() eq $document->getCategoryid()-|selected="selected"|-/if-|>|-$category->getName()-|</option>
			|-/foreach-|
               </select>
		 </td>
      </tr>
	  <tr class="row_even"> 
         <td class="style6">Descripci&oacute;n:&nbsp;</td>
         <td><textarea name="description" cols="40" rows="7" wrap="VIRTUAL"  class="TXTnormal">|-$document->getDescription()-|</textarea></td>
       </tr>
       <tr align="right"> 
         <td colspan="2"> <input name="save" type="submit" class="botonchico" value="Editar Documento"> 
         </td>
        </tr>
     </table>
     </form> 
</table>

 
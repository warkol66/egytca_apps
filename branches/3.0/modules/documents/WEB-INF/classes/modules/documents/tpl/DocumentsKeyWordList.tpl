<h2>##documents,5,Documentos##</h2>
<h1>Lista de palabras clave disponibles</h1>
<p>Listado de palabras clave disponibles en el sistema</p>

|-if $keyWords neq ''-|
	<fieldset name="Listado de palabras clave disponibles">
		<legend>Palabras clave</legend>
		<table width="100%" cellpadding="5" cellspacing="0" class="tableTdBorders">
			<COL width="20%" />
			<COL width="20%" />
			<COL width="20%" />
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=documentsKeyWordEdit" class="addLink" title="Agregar palabra clave">Agregar palabra clave</a></div></th>
			</tr>
			|-if $keyWords|@count eq 0-|
			<tr>
				<td colspan="3"> Aun no hay publicaciones en esta categoría</td>
			</tr>
			|-/if-|
			<tr valign="top">	
	|-foreach from=$keyWords item=keyWord name=foreach_keyWord-|
|-if $smarty.foreach.foreach_keyWord.index mod 3 eq 0 && !$smarty.foreach.foreach_keyWord.first-|</tr>|-if !$smarty.foreach.foreach_keyWord.last-|<tr valign="top">|-/if-||-/if-|
				<td><div style="float:right; vertical-align:top"><a href="Main.php?do=documentsKeyWordEdit&id=|-$keyWord->getId()-|"><img src="images/clear.png" class="linkImageEdit" /></a></div>|-$keyWord->getKeyWord()-|</td>
|-if $smarty.foreach.foreach_keyWord.last-|
|-math equation = "n - a % n" n=3 a=$keyWords|@count assign="modCells"-|
|-if $modCells neq 3-|
|-section loop=$modCells name=foreach_modCells-|<td>&nbsp;</td>|-/section-||-/if-||-/if-|
		|-/foreach-|
		</tr>
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=documentsKeyWordEdit" class="addLink" title="Agregar palabra clave">Agregar palabra clave</a></div></th>
			</tr>
		</table>
	</fieldset>
|-/if-|
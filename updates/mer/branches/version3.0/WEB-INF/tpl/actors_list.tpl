<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>##40,Configuración del Sistema##</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>##126,Editar Actores##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##127,A continuación podrá administrar los Actores ingresados en el sistema ##.</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
|-if $actors|count gt 0-|
<table class='tablaborde' width='100%' border='0' cellspacing='1' cellpadding='5'>
	<tr>
		<th width="60%">##101,Nombre del Actor##</th>
		<th width="35%">##102,Categoría##</th>
		<th width="5%">&nbsp;</th>
	</tr>
	|-foreach from=$actors item=actor name=for_actors_category-|
	<tr valign="top">
		<td class='celldato'><span class='titulo2'>|-$actor->getName()-|</span></td>
		<td class='celldato'> |-assign var="category" value=$actor->getCategory()-|
			|-if $category ne ""-||-$category->getName()-||-/if-| </td>
		<td class='cellopciones' nowrap>[ <a href='Main.php?do=actorsEditActorCategory&action=edit&actor=|-$actor->getId()-|' class='edit'>##114,Editar##</a> ]
			[ <a href='Main.php?do=actorsDoDeleteActor&action=edit&actor=|-$actor->getId()-|' class='elim' onclick="return confirm('##116,Esta opción eliminar permanentemente a este Actor\n¿Está seguro que desea eliminarlo?##');">##115,Eliminar##</a> ]</td>
	</tr>
	|-/foreach-|
</table>
|-/if-| 
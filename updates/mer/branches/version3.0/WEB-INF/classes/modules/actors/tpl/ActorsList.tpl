<h2>Configuración del Sistema</h2>
	<h1>Editar Actores</h1>
	<p>A continuación podrá administrar los Actores ingresados en el sistema.</p>
|-if $actors|count gt 0-|
<table class='tableTdBorders' width='100%' border='0' cellspacing='1' cellpadding='5'>
	<tr>
		<th width="60%">##101,Nombre del Actor##</th>
		<th width="35%">##102,Categoría##</th>
		<th width="5%">&nbsp;</th>
	</tr>
	|-foreach from=$actors item=actor name=for_actors_category-|
	<tr valign="top">
		<td> <span class='titulo2'>|-$actor->getName()-|</span></td>
		<td> |-assign var="category" value=$actor->getCategory()-|
			|-if $category ne ""-||-$category->getName()-||-/if-| </td>
		<td class='cellopciones' nowrap><a href='Main.php?do=actorsEditActorCategory&action=edit&actor=|-$actor->getId()-|' title="Editar"><img src="images/clear.png" class="icon iconEdit" /></a>
			<a href='Main.php?do=actorsDoDeleteActor&action=edit&actor=|-$actor->getId()-|' title="Eliminar" onclick="return confirm('##116,Esta opción eliminar permanentemente a este Actor\n¿Está seguro que desea eliminarlo?##');"><img src="images/clear.png" class="icon iconDelete" /></a></td>
	</tr>
	|-/foreach-|
</table>
|-/if-| 
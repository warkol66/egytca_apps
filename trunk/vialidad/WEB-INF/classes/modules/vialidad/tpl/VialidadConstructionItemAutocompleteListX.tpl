<ul>
	|-if count($items) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$items item=item-|
			<li id="|-$item->getId()-|">|-$item->getName()-|</li>
		|-/foreach-|
		|-if count($item) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
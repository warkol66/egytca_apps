<ul>
	|-if count($suppliers) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$suppliers item=supplier-|
			<li id="|-$supplier->getId()-|">|-$supplier->getName()-|</li>
		|-/foreach-|
		|-if count($suppliers) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
<ul>
	|-if count($constructions) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$constructions item=construction-|
			<li id="|-$construction->getId()-|">|-$construction->getName()-|</li>
		|-/foreach-|
		|-if count($construction) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>

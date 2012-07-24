<ul>
	|-if count($relations) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$relations item=relation-|
			<li id="|-$relation->getId()-|">|-if ($relation->getName() ne '')-||-$relation->getName()-| |-/if-|</li>
		|-/foreach-|
		|-if count($relations) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
<ul>
	|-if count($modulesEntities) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$modulesEntities item=moduleEntity-|
			<li id="|-$moduleEntity->getName()-|">|-$moduleEntity->getPhpName()-|</li>
		|-/foreach-|
		|-if count($modulesEntities) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
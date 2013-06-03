<ul>
	|-if $contracts->count() == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$contracts item=contract-|
			<li id="|-$contract->getId()-|">|-$contract->getName()-|</li>
		|-/foreach-|
		|-if count($contracts) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
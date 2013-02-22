<ul>
	|-if count($positions) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$positions item=position-|
			<li id="|-$position->getCode()-|">|-$position-|</li>
		|-/foreach-|
		|-if count($positions) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
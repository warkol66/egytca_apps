<ul>
	|-if count($supplies) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$supplies item=supply-|
			<li id="|-$supply->getId()-|">|-$supply->getName()-|</li>
		|-/foreach-|
		|-if count($supplies) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
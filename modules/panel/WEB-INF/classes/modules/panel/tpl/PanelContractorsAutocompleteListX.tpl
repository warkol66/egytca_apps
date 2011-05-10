<ul>
	|-if count($contractors) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$contractors item=contractor-|
			<li id="|-$contractor->getId()-|">|-$contractor->getName()-|</li>
		|-/foreach-|
		|-if count($contractors) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
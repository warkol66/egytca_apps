<ul>
	|-if count($objects) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$objects item=object-|
			<li id="|-$object->getId()-|">|-$object-|</li>
		|-/foreach-|
		|-if count($objects) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>

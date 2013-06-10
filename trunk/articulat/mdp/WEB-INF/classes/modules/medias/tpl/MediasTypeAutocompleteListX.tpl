<ul>
	|-if count($mediaTypes) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$mediaTypes item=mediaType-|
			<li id="|-$mediaType->getId()-|">|-if ($mediaType->getName() ne '') or ($mediaType->getSurname() ne '')-||-$mediaType->getName()-| |-$mediaType->getSurname()-||-if $mediaType->getInstitution() ne ''-| - (|-$mediaType->getInstitution()-|)|-/if-||-/if-|</li>
		|-/foreach-|
		|-if count($mediaTypes) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
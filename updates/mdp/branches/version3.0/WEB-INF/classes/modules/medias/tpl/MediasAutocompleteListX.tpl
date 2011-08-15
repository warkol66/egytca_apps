<ul>
	|-if count($medias) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$medias item=media-|
			<li id="|-$media->getId()-|">|-if ($media->getName() ne '') or ($media->getSurname() ne '')-||-$media->getName()-| |-$media->getSurname()-||-if $media->getInstitution() ne ''-| - (|-$media->getInstitution()-|)|-/if-||-/if-|</li>
		|-/foreach-|
		|-if count($medias) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
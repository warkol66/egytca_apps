<ul>
	|-if count($actors) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$actors item=actor-|
			<li id="|-$actor->getId()-|">|-if ($actor->getName() ne '') or ($actor->getSurname() ne '')-||-$actor->getName()-| |-$actor->getSurname()-||-if $actor->getInstitution() ne ''-| - (|-$actor->getInstitution()-|)|-/if-||-/if-|</li>
		|-/foreach-|
		|-if count($actors) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
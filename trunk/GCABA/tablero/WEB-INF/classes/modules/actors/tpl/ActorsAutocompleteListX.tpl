|-if $type eq 'json'-|
	{
		|-foreach $actors as $actor-|
			"|-json_encode($actor->getId())-|": |-json_encode($actor->getName()|cat:' '|cat:$actor->getSurname())-|
			|-if !$actor@last-|,|-/if-|
		|-/foreach-|
	}
|-else-|
<ul>
	|-if count($actors) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$actors item=actor-|
			<li id="|-$actor->getId()-|">|-$actor-|</li>
		|-/foreach-|
		|-if count($actors) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
|-/if-|
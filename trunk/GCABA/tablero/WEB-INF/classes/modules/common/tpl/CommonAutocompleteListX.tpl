|-if !empty($objectParam)-||-assign var=method value="get"|cat:$objectParam-||-else-||-assign var=method value="getId"-||-/if-|
|-if $type eq 'json'-|
	{
		|-foreach from=$objects item=object-|
			"|-json_encode($object->$method())-|": |-json_encode(''|cat:$object)-||-if !$object@last-|,|-/if-|
		|-/foreach-|
	}
|-else-|
<ul>
	|-if count($objects) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$objects item=object-|
			<li id="|-$object->$method()-|">|-$object-|</li>
		|-/foreach-|
		|-if count($objects) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
|-/if-|
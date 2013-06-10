<ul>
	|-if count($campaigns) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$campaigns item=campaign-|
			<li id="|-$campaign->getId()-|">|-$campaign-|</li>
		|-/foreach-|
		|-if count($campaigns) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
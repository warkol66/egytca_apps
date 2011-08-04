<ul>
	|-if count($issues) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$issues item=issue-|
			<li id="|-$issue->getId()-|">|-if ($issue->getName() ne '')-||-$issue->getName()-| |-/if-|</li>
		|-/foreach-|
		|-if count($issues) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
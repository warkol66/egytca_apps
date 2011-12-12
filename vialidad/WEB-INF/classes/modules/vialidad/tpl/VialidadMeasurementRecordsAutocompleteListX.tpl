<ul>
	|-if count($records) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$records item=record-|
			|-assign var=construction value=$record->getConstruction()-|
			<li id="|-$record->getId()-|">|-$construction->getName()-| - |-$record->getMeasurementDate()|date_format:"%B / %Y"|@ucfirst-|</li>
		|-/foreach-|
		|-if count($item) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
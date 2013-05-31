<ul>
	|-foreach $certificates  as $certificate-|
		|-$construction = $certificate->getMeasurementRecord()->getConstruction()-|
		<li id="|-$certificate->getId()-|">|-$construction->getName()-| - |-$certificate->getMeasurementRecord()->getMeasurementDate()|date_format:"%B / %Y"|@ucfirst-|</li>
	|-foreachelse-|
		<b>No hay resultados que coincidan</b>
	|-/foreach-|
	|-if count($certificates) == $limit-|
		<b>Está viendo los primeros |-$limit-| resultados</b>
	|-/if-|
</ul>
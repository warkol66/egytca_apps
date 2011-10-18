<ul>
	|-if count($verifiers) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$verifiers item=verifier-|
			<li id="|-$verifier->getId()-|">|-$verifier->getName()-|</li>
		|-/foreach-|
		|-if count($verifiers) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
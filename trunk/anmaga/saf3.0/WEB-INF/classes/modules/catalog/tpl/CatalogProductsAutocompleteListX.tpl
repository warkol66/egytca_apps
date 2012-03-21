<ul>
	|-if count($products) == 0-|
		<b>No hay resultados que coincidan</b>
	|-else-|
		|-foreach from=$products item=product-|
			<li id="|-$product->getId()-|">|-$product-|</li>
		|-/foreach-|
		|-if count($products) == $limit-|
			<b>Está viendo los primeros |-$limit-| resultados</b>
		|-/if-|
	|-/if-|
</ul>
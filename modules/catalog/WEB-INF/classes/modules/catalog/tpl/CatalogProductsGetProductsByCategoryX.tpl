|-foreach from=$products key=key item=product-|
	<li><input type="checkbox" name="survey[productsIds][|-$key-|]" value="|-$product->getId()-|" />|-$product-|</li>
|-/foreach-|
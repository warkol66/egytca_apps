<h2>Headlines:</h2>

|-foreach from=$collection item=headline-|
	<p>|-$headline->getName()-|</p>
|-/foreach-|
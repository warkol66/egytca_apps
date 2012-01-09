<h3>Titulares</h3>
|-foreach from=$collection item=headline-|
	<p>|-$headline-| <a href="Main.php?do=headlinesEdit&id=|-$headline->getId()-|" class="icon iconView inlineTable" target="_blank"></a></p>
|-/foreach-|
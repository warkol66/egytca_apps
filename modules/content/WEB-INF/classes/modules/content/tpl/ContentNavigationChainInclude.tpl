<div id="navigationChain">
<p><span class="navChain">
	|-foreach from=$navigationChain item=item name=navigation-|
		|-$temp=$item->setLocale($defaultLanguage->getLanguagecode())-|
		|-if not $smarty.foreach.navigation.first-| > |-/if-|

		<a href="Main.php?do=contentList&sectionId=|-$item->getId()-|" class="path_Mark" title="ir a |-$item->getTitleinmenu()-|">|-$item->getTitleinmenu()-|</a>
	|-/foreach-|
</span></p>
</div>
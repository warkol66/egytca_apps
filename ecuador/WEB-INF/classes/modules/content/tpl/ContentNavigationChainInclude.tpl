<div id="navigationChain">
<p><span class="navChain">
	|-foreach from=$navigationChain item=item name=navigation-|
		|-$temp=$item->setLocale($defaultLanguage->getLanguagecode())-|
		<a href="Main.php?do=contentList&sectionId=|-$item->getId()-|" class="|-if not $smarty.foreach.navigation.first-|path_Mark|-else-|path_Base|-/if-|" title="ir a |-$item->getTitleinmenu()-|">|-$item->getTitleinmenu()-|</a>
	|-/foreach-|
</span></p>
</div>
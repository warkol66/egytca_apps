<div id="navigationChain">
<p><span class="navChain">
	|-foreach from=$navigationChain item=item name=navigation-||-if not $smarty.foreach.navigation.last-|<a href="Main.php?do=contentList&sectionId=|-$item.id-|" class="path_Mark" title="ir a |-$item.titleInMenu-|">|-$item.titleInMenu-|</a>|-else-|<span class="path_Mark_current">|-$item.titleInMenu-|</span>|-/if-||-/foreach-|
</span></p>
</div>
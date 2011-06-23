|-if $result.menuItem ne '' -|
<div class="leftMenu">
	<nav>
		<div>
			|-include file="CommonMenuItemsRecursiveInclude.tpl" menuItems=$result.menuItem->getAllChilds() menuType="left" parentId=$result.menuItem->getId()-|
		</div>
	</nav>
</div>
|-/if-|
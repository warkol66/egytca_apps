|-if $result.menuItem ne '' -|
<div class="horizontalMenu">
	<nav>
		|-include file="CommonMenuItemsRecursiveInclude.tpl" menuItems=$result.menuItem->getAllChilds() menuType="horizontal" parentId=$result.menuItem->getId()-|
	</nav>
</div>
|-/if-|
|-if $menuItem ne '' -|
|-assign var=menuInfo value=$menuItem->getMenuInfo()-|
<h1>|-$menuInfo->getName()-|</h1>
<div class="horizontalMenu">
	<nav>
		|-include file="CommonMenuItemsRecursiveInclude.tpl" menuItems=$menuItem->getAllChilds() menuType="horizontal" parentId=$menuItem->getId()-|
	
	</nav>
</div>
|-/if-|
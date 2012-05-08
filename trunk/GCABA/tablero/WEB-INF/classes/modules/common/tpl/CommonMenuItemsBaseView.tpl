|-if $result.menuItem ne '' -|
<div class="baseMenu">
	<nav>
		|-include file="CommonMenuItemsRecursiveInclude.tpl" menuItems=$result.menuItem->getAllChilds() menuType="base"-|
	</nav>
</div>
|-/if-|
|-if $menuType eq "base"-|
	<ul class="baseMenu">
		|-foreach from=$menuItems item=menuItem-|
		|-assign var=childs value=$menuItem->getAllChilds()-|
				<li>
					|-assign var=menuInfo value=$menuItem->getMenuInfo()-|
					<a href="|-$menuItem->getUrl()-|" title="|-$menuInfo->getTitle()-|">|-$menuInfo->getName()-|</a>
					|-include file="CommonMenuItemsRecursiveInclude.tpl" menuItems=$childs-|
				</li>
		|-/foreach-|
	</ul>
|-elseif $menuType eq "siteMap"-|
	<ul class="baseMenu">
		|-foreach from=$menuItems item=menuItem-|
		|-assign var=childs value=$menuItem->getAllChilds()-|
				<li>
					|-assign var=menuInfo value=$menuItem->getMenuInfo()-||-if $menuItem->getUrl() ne ''-|
					<a href="|-$menuItem->getUrl()-|" title="|-$menuInfo->getTitle()-|">|-/if-||-$menuInfo->getName()-|</a> |-$menuInfo->getDescription()-|
					|-include file="CommonMenuItemsRecursiveInclude.tpl" menuItems=$childs-|
				</li>
		|-/foreach-|
	</ul>
|-elseif $menuType eq "horizontal"-|
	<ul class="menu">
		|-assign var=itName value="it_$parentId"-|
		|-foreach from=$menuItems item=menuItem name="$itName"-|
		|-assign var=childs value=$menuItem->getAllChilds()-|
				<li |-if $smarty.foreach.$itName.last-|class="last"|-/if-|>
					|-assign var=menuInfo value=$menuItem->getMenuInfo()-|
					<a title="|-$menuInfo->getTitle()-|" |-if !$childs->isEmpty() -|class="sub"|-/if-| href="|-$menuItem->getUrl()-|">|-$menuInfo->getName()-|</a>
					|-include file="CommonMenuItemsRecursiveInclude.tpl" menuItems=$childs parentId=$menuItem->getId()-|
				</li>
		|-/foreach-|
	</ul>
|-elseif $menuType eq "left"-|
	<ul >
		|-assign var=itName value="it_$parentId"-|
		|-foreach from=$menuItems item=menuItem name="$itName"-|
		|-assign var=childs value=$menuItem->getAllChilds()-|
				<li |-if !$childs->isEmpty() -|class="titleMenu"|-else-|class="menuLink"|-/if-|>
					|-assign var=menuInfo value=$menuItem->getMenuInfo()-|
					<a |-if !$childs->isEmpty() -|href="javascript:switch_vis('menu_|-$menuItem->getId()-|');" class="linkSwitchMenu"|-else-|href="|-$menuItem->getUrl()-|"|-/if-| title="|-$menuInfo->getTitle()-|" >|-$menuInfo->getName()-|</a>
					<div id="menu_|-$menuItem->getId()-|" style="display:none;" >
						|-include file="CommonMenuItemsRecursiveInclude.tpl" menuItems=$childs parentId=$menuItem->getId()-|
					</div>
				</li>
		|-/foreach-|
	</ul>
<!-- Esta se usa para el CommonMenuItemsList, tiene una vista simple y cada item tiene botones de editar, eliminar, etc...-->
|-elseif $menuType eq "editableTree"-|
	<ul id="menuItemsList_|-$parentId-|" class="menuItemsList">
		|-foreach from=$menuItems item=menuItem-|
		|-assign var=childs value=$menuItem->getAllChilds()-|
		<li id="menuItemsListItem_|-$menuItem->getId()-|" class="menuItemLi editableTree">	
			<span class="textOptionMove" style="float:left;" title="Mover este contenido">
			|-if !$childs->isEmpty()-|<a href="#" class="expandButton" onClick="expandContract('menu_|-$menuItem->getId()-|',this); return false;" style="text-decoration: none;">+</a>|-/if-|
				|-assign var=menuInfo value=$menuItem->getMenuInfo()-|
				|-if $menuInfo ne '' && $menuInfo->getName() ne ''-|
					|-$menuInfo->getName()-|
				|-else-|
					<!-- si no hay traduccion del nombre para el idioma actual mostramos el id -->
					|-$menuItem->getId()-|
				|-/if-|
			</span>
			<span style="float:right;text-align:right; padding: 3px 0 3px 0">
				|-if !$childs->isEmpty()-|
					<a href="Main.php?do=commonMenuItemsShow&id=|-$menuItem->getId()-|" alt="Ver" title="Ver" target="_blank"><img src="images/clear.png" class="linkImageView"></a>
					<a href="Main.php?do=commonMenuItemsList&parentId=|-$menuItem->getId()-|" alt="Ver submenú" title="ver submenú"><img src="images/clear.png" class="linkImageGoTo"></a>
				|-/if-|
				<a href="Main.php?do=commonMenuItemsEdit&parentId=|-$menuItem->getId()-|" alt="Agregar SubMenú" title="Agregar SubMenú" ><img src="images/clear.png" class="linkImageAdd" ></a>
				<a href="Main.php?do=commonMenuItemsEdit&id=|-$menuItem->getId()-|" alt="Editar" title="Editar"><img src="images/clear.png" class="linkImageEdit"></a>
				<a href="#" onclick='if (confirm("¿Seguro que desea eliminar el menú y todos sus submenús?")){new Ajax.Updater("operationInfo", "Main.php?do=commonMenuItemsDoDeleteX", { method: "post", parameters: { id: "|-$menuItem->getId()-|"}, evalScripts: true})};return false;' alt="Eliminar" title="Eliminar"><img src="images/clear.png" class="linkImageDelete"></a>
			</span>
			<br style="clear: all" />
			<div id="menu_|-$menuItem->getId()-|" class="subMenus" style="display:none;">
				|-include file="CommonMenuItemsRecursiveInclude.tpl" menuItems=$childs menuType="editableTree" parentId=$menuItem->getId()-|
			</div>
		</li>
		|-/foreach-|
	</ul>
	<script type="text/javascript">
   	Sortable.create("menuItemsList_|-$menuItem->getParentId()-|", {
		onUpdate: function() {  
				$('orderChanged').innerHTML = "<span class='inProgress'>Cambiando orden...</span>";
				new Ajax.Updater("orderChanged", "Main.php?do=commonMenuItemsDoEditOrderX",
					{
						method: "post",  
						parameters: { parentId: '|-$parentId-|' , data: Sortable.serialize("menuItemsList_|-$parentId-|", {name: 'menuItemsList'}) }
					});
				} 
			});
 	</script>
|-/if-|
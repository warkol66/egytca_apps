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
	<ul id="menuItemsList" class="ui-sortable">
		|-foreach from=$menuItems item=menuItem-|
		|-assign var=childs value=$menuItem->getAllChilds()-|
		<li id="menuItemsListItem_|-$menuItem->getId()-|" class="menuItemLi editableTree">	
			<span class="textOptionMove" style="float:left;" title="Mover este contenido">
			|-if !$childs->isEmpty()-|<a href="#" class="expandButton" onClick="expandContract('menu_|-$menuItem->getId()-|',$(this)); return false;" style="text-decoration: none;">+</a>|-/if-|
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
					<a href="Main.php?do=commonMenuItemsShow&id=|-$menuItem->getId()-|" alt="Ver" title="Ver" target="_blank"><img src="images/clear.png" class="icon iconView"></a>
					<a href="Main.php?do=commonMenuItemsList&parentId=|-$menuItem->getId()-|" alt="Ver submenú" title="ver submenú"><img src="images/clear.png" class="icon iconGoTo"></a>
				|-/if-|
				<a href="Main.php?do=commonMenuItemsEdit&parentId=|-$menuItem->getId()-|" alt="Agregar SubMenú" title="Agregar SubMenú" ><img src="images/clear.png" class="icon iconAdd" ></a>
				<a href="Main.php?do=commonMenuItemsEdit&id=|-$menuItem->getId()-|" alt="Editar" title="Editar"><img src="images/clear.png" class="icon iconEdit"></a>
				<a href="#" onclick='if (confirm("¿Seguro que desea eliminar el menú y todos sus submenús?")){new Ajax.Updater("operationInfo", "Main.php?do=commonMenuItemsDoDeleteX", { method: "post", parameters: { id: "|-$menuItem->getId()-|"}, evalScripts: true})};return false;' alt="Eliminar" title="Eliminar"><img src="images/clear.png" class="icon iconDelete"></a>
			</span>
			<br style="clear: all" />
			<div id="menu_|-$menuItem->getId()-|" class="subMenus" style="display:none;">
			|-if !$childs->isEmpty()-|
				|-include file="CommonMenuItemsRecursiveInclude.tpl" menuItems=$childs menuType="editableTree" parentId=$menuItem->getId()-|
			|-/if-|
			</div>
		</li>
		|-/foreach-|
	</ul>
	<script type="text/javascript">
		$(function(){
		$("#menuItemsList").sortable({
			placeholder: "ui-state-highlight",
			update:function(){
				var lis=$("#menuItemsList > li");
				var data= { parentId: '|-$parentId-|' , data: $('#menuItemsList').sortable('serialize')};
				for(var i=0;i<lis.size();i++){
					data+="&orden[]="+lis.get(i).id.replace("contentList_","");
				}
				$.post("Main.php?do=commonMenuItemsDoEditOrderX",data,function(response){
					$("#orderChanged").html(response);
					$("#orderChanged").show("slow")
					setTimeout('$("#orderChanged").hide("slow")',3000);
				},"html");
			}
		}).disableSelection();
   });
		/*$('#menuItemsList_|-$menuItem->getParentId()-|').sortable({
			update: function(){
				$('orderChanged').html("<span class='inProgress'>Cambiando orden...</span>");
				$.ajax({
					url: 'Main.php?do=commonMenuItemsDoEditOrderX',
					//ver el serialize
					data: { parentId: '|-$parentId-|' , data: Sortable.serialize("menuItemsList_|-$parentId-|", {name: 'menuItemsList'}) },
					type: 'post',
					success: function(data){
						$('#orderChanged').html(data);
					}	
				});
			}
		});
   	/*Sortable.create("menuItemsList_|-$menuItem->getParentId()-|", {
		onUpdate: function() {  
				$('orderChanged').innerHTML = "<span class='inProgress'>Cambiando orden...</span>";
				new Ajax.Updater("orderChanged", "Main.php?do=commonMenuItemsDoEditOrderX",
					{
						method: "post",  
						parameters: { parentId: '|-$parentId-|' , data: Sortable.serialize("menuItemsList_|-$parentId-|", {name: 'menuItemsList'}) }
					});
				} 
			});*/
 	</script>
|-/if-|

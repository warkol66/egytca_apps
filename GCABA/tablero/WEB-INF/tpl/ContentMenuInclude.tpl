<ul>
|-foreach from=$result.menuDown.menu item=item-|
	|-if $item.type neq 2-|
		|-if $item.id neq $contentData.id-|<li |-if $contentData.id|is_descendant:$item.id-|class="current"|-/if-|><a href="Main.php?do=contentShow&id=|-$item.id-|" title="|-$item.titleInMenu-|">|-$item.titleInMenu-|</a>|-else-|<li style="background-image:none;"|-if $contentData.id|is_descendant:$item.id-| class="current"|-/if-|><span class="current">|-$item.titleInMenu-|</span>|-/if-|
	|-else-|
		|-if $item.id neq $contentData.id-|<li><a href="|-$item.link-|" title="|-$item.titleInMenu-|" target="|-if $item.target neq 1-|_self|-else-|_blank|-/if-|">|-$item.titleInMenu-|</a>|-else-|<li style="background-image:none;"><span class="current">|-$item.titleInMenu-|</span>|-/if-|
	|-/if-|
|-* Caso de llamada recursiva si se quisiera mostrar el menu en toda profundidad *-|
|-* En caso de querer utilizarlo, descomentar abajo y comentar el caso de Un nivel de profundidad  *-|
		|-if ($item.childs|@count gt 0 && $item.id eq $contentData.id) || ($item.childs|@count gt 0 && $item.id eq $contentData.parent)-|
			|-include file="ContentMenuRecursiveInclude.tpl" result=$item.childs-|
		|-/if-|
	</li>
|-/foreach-|
<!--|-if $result.parentId neq ''-|
	<li>
		<a href="Main.php?do=contentShow&id=|-$result.parentId-|">Volver Arriba</a>
	</li>
|-/if-|-->
</ul>
|-*include file="ContentMenuUpInclude.tpl"*-|

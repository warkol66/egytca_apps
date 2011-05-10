<ul>
|-foreach from=$result item=item-|
	<li>
		|-if $item.type neq 2-|
			|-if $item.id neq $contentData.id-|<a href="Main.php?do=contentShow&id=|-$item.id-|" title="|-$item.titleInMenu-|">&gt; |-$item.titleInMenu-|</a>|-else-|<span class="current">|-$item.titleInMenu-|</span>|-/if-|
		|-else-|
			|-if $item.id neq $contentData.id-|<a href="|-$item.link-|" title="|-$item.titleInMenu-|" target="_blank">|-$item.titleInMenu-|</a>|-else-|<span class="current">|-$item.titleInMenu-|</span>|-/if-|
		|-/if-|
<!-- Caso de llamada recursiva si se quisiera mostrar el menu en toda profundidad -->
<!-- En caso de querer utilizarlo, descomentar abajo y comentar el caso de Un nivel de profundidad -->
		|-if $item.childs|@count gt 0-|
			|-include file="ContentMenuRecursiveInclude.tpl" menuValues=$item.childs-|
		|-/if-|
<!-- Fin Caso de llamada Recursiva -->

	</li>
|-/foreach-|
</ul>
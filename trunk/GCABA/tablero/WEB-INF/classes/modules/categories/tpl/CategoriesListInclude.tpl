<ul>
|-foreach from=$categories item=category name=for_categories-|
	<li>
		<span class='titulo2'>|-$category->getName()-|</span>
	</li>		
	|-assign var=childrens value=$category->getChildrenCategoriesByUser($loginUser)-|
	|-if $childrens|@count neq 0-|
		|-include file="CategoriesListInclude.tpl" categories=$childrens-|
	|-/if-|

|-/foreach-|
</ul>

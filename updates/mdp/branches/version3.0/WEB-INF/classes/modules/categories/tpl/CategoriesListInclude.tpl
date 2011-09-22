<ul class="iconOptionsList">
|-foreach from=$categories item=category name=for_categories-|
	<li>|-$category-|</li>		
	|-assign var=childrens value=$category->getChildrenCategoriesByUser($loginUser)-|
	|-if $childrens|@count neq 0-|
		|-include file="CategoriesListInclude.tpl" categories=$childrens-|
	|-/if-|
|-/foreach-|
</ul>

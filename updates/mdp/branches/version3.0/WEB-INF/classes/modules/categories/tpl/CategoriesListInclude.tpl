<ul>
	<div id="categoriesListPlaceHolder">
|-foreach from=$categories item=category name=for_categories-|
	<li>|-$category->getName()-|</li>		
	|-assign var=childrens value=$category->getChildrenCategoriesByUser($loginUser)-|
	|-if $childrens|@count neq 0-|
		|-include file="CategoriesListInclude.tpl" categories=$childrens-|
	|-/if-|
|-/foreach-|
		</div>
</ul>

|-foreach from=$categories item=category name=for_categories-|
	|-if $category->getId() ne $actual-|
		<option value="|-$category->getId()-|" |-$category->getId()|selected:$selected-| |-$category->getId()|selected:$selectedCategoryId-|>|-section name=spacesCategories start=0 loop=$count-|&nbsp; &nbsp; |-/section-||-$category-|</option>
	|-/if-|
	|-assign var=newCount value=$count+1-|
	|-assign var=childrens value=$category->getChildrenCategoriesByUser($loginUser)-|
	|-if $childrens|@count neq 0-|
		|-include file="CategoriesOptionsInclude.tpl" categories=$childrens count=$newCount user=$loginUser selected=$selected-|
	|-/if-|
|-/foreach-|

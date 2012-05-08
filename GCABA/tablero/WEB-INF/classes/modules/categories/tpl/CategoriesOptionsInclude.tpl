|-foreach from=$categories item=category name=for_categories-|
	|-if $category->getId() ne $actual-|
		<option value="|-$category->getId()-|" |-if $category->getId() eq $selected-|selected="selected"|-/if-| |-if $selectedCategoryId neq '' and $category->getId() eq $selectedCategoryId-|selected="selected"|-/if-|>|-section name=spacesCategories start=0 loop=$count-|&nbsp;&nbsp;&nbsp;&nbsp;|-/section-||-$category->getName()-|</option>
	|-/if-|
	|-assign var=newCount value=$count+1-|
	|-assign var=childrens value=$category->getChildrenCategoriesByUser($loginUser)-|
	|-if $childrens|@count neq 0-|
		|-include file="CategoriesOptionsInclude.tpl" categories=$childrens count=$newCount user=$loginUser selected=$selected-|
	|-/if-|
|-/foreach-|

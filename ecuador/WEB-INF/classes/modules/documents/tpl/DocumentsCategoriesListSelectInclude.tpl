|-foreach from=$categories item=category name=for_categories-|
		<option value="|-$category->getId()-|" |-if $categoryId eq $category->getId()-|selected="selected"|-/if-|>|-section name=spacesCategories start=0 loop=$count-|&nbsp;&nbsp;&nbsp;&nbsp;|-/section-||-$category->getName()-|&nbsp;(|-$category->getDocumentsCount()-|)</option>
	|-assign var=newCount value=$count+1-|
	|-assign var=childrens value=$user->getDocumentsChildrenCategories($category->getId())-|
	|-if $childrens|@count neq 0-|
		|-*include file="DocumentsCategoriesListSelectInclude.tpl" categories=$childrens count=$newCount document=$document user=$user*-|
	|-/if-|
|-/foreach-|

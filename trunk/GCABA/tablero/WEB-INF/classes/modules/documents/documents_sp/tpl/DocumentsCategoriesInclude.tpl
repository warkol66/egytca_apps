|-foreach from=$categories item=category name=for_categories-|
		<option value="|-$category->getId()-|" |-if $document neq '' and $category->getId() eq $document->getCategoryid()-|selected="selected"|-/if-| |-if $selectedCategoryId neq '' and $category->getId() eq $selectedCategoryId-|selected="selected"|-/if-|>|-section name=spacesCategories start=0 loop=$count-|&nbsp;&nbsp;&nbsp;&nbsp;|-/section-||-$category->getName()-|</option>
	|-math equation="x+y" x=$count y=1 assign=newCount-|
	|-assign var=childrens value=$user->getDocumentsChildrenCategories($category->getId())-|
	|-if $childrens|@count neq 0-|
		|-include file="DocumentsCategoriesInclude.tpl" categories=$childrens count=$newCount document=$document user=$user-|
	|-/if-|
|-/foreach-|

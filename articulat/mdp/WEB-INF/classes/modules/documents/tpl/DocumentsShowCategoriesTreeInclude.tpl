<ul>
|-foreach from=$categories item=category name=for_categories-|
	|-assign var=childrens value=$user->getDocumentsChildrenCategories($category->getId())-|
	|-if $childrens|@count gt 0 || $category->getDocumentsCount() gt 0-|
		<li><a href="Main.php?do=documentsShow&amp;categoryId=|-$category->getId()-|" |-if ($selectedCategory) neq '' && ($selectedCategory->getId() eq $category->getId())-|class="selected"|-/if-|>|-$category->getName()-||-if $category->getDocumentsCount() gt 0-| (|-$category->getDocumentsCount()-|)|-/if-|</a></li>
		|-if $childrens|@count neq 0-|
		<li>|-include file="DocumentsShowCategoriesTreeInclude.tpl" categories=$childrens user=$user selectedCategory=$selectedCategory-|</li>
		|-/if-|
	|-/if-|
|-/foreach-|
</ul>


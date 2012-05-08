<ul>
|-foreach from=$categories item=category name=for_categories-|
		<li>
			<span class="titulo2"><a href="Main.php?do=documentsList&amp;categoryId=|-$category->getId()-|">|-if ($selectedCategory) neq '' and ($selectedCategory->getId() eq $category->getId())-|<strong>|-/if-||-$category->getName()-| (|-$category->getDocumentsCount()-|)|-if ($selectedCategory) neq '' and ($selectedCategory->getId() eq $category->getId())-|</strong>|-/if-|</a></span>
		</li>
		|-assign var=childrens value=$user->getDocumentsChildrenCategories($category->getId())-|
		|-if $childrens|@count neq 0-|
			|-include file="DocumentsCategoriesTreeInclude.tpl" categories=$childrens user=$user selectedCategory=$selectedCategory-|
		|-/if-|
|-/foreach-|
</ul>


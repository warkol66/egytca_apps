<ul>
|-foreach from=$categories item=category name=for_categories-|
		|-if ($category->isPublic())-|
			<li>
				<span class="titulo2">|-if ($selectedCategory) neq '' and ($selectedCategory->getId() eq $category->getId())-|<strong>|-/if-||-$category->getName()-| (|-$category->getDocumentsCount()-|)|-if ($selectedCategory) neq '' and ($selectedCategory->getId() eq $category->getId())-|</strong>|-/if-|</a></span>
			</li>
			|-assign var=childrens value=$category->getChildrenPublicCategories()-|
			|-if $childrens|@count neq 0-|
				|-include file="DocumentsPublicCategoriesTreeInclude.tpl" categories=$childrens user=$user selectedCategory=$selectedCategory-|
			|-/if-|
		|-/if-|
|-/foreach-|
</ul>


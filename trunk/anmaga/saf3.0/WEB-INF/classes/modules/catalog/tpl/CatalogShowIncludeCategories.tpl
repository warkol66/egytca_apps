					<ul>
						|-foreach from=$productCategories item=productCategory name=for_productCategories-|
							<li>
								<a href="Main.php?do=catalogShow&categoryId=|-$productCategory->getId()-|">|-$productCategory->getName()-|</a>
								|-if $productCategory->hasChildren()-|
									|-include file="CatalogShowIncludeCategories.tpl" productCategories=$productCategory->getChildren()-|
								|-/if-|
							</li>
						|-/foreach-|
					</ul>

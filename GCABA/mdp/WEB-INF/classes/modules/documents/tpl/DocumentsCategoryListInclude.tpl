

|-if ($result.partialCategories) neq ''-|
	|-assign var=partialCategories value=$result.partialCategories-|
	|-assign var=category value=$result.category-|
	<div id="categoriesListPlaceHolder">
		<!--pedido de todos los modulos y categorias generales y documentos sin categorias -->
		<fieldset>
				<p>Categorias dentro de |-$category->getName()-|</p>
				|-include file="DocumentsPublicCategoriesTreeInclude.tpl" categories=$partialCategories-|
			<br />
		</fieldset>
	</div>
|-else-|
	|-assign var=documentsWithoutCategoryCount value=$result.documentsWithoutCategoryCount-|
	|-assign var=generalParentCategories value=$result.generalParentCategories-|
	|-assign var=modules value=$result.modules-|
		
	<div id="categoriesListPlaceHolder">
		<!--pedido de todos los modulos y categorias generales y documentos sin categorias -->
		<fieldset>
			<legend>Categorias Disponibles</legend>
			<p>Documentos sin categorias</p>
				<ul>
					<li>
						|-if $categoryId eq 0-|<strong>|-/if-|documentos sin categoria (|-$documentsWithoutCategoryCount-|)|-if $categoryId eq 0-|</strong>|-/if-|
					</li>
				</ul>
			<br />
			|-if $generalParentCategories|@count neq 0-|
				<p>Categorias Generales</p>
				|-include file="DocumentsPublicCategoriesTreeInclude.tpl" categories=$generalParentCategories-|
			|-/if-|
			<br />
		|-foreach from=$modules item=module-|
				<p>Categorias en |-$module->getName()-|</p>
				|-assign var=categories value=$module->getPublicParentCategories()-|
					|-include file="DocumentsPublicCategoriesTreeInclude.tpl" categories=$categories-|
			</p>
		|-/foreach-|
		</fieldset>
	</div>
|-/if-|
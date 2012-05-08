<div id="categoriesListPlaceHolder">
	<!--pedido de un unico modulo -->
	|-if ($selectedModule neq '')-|
		<fieldset>
			<legend>Categorías en |-$selectedModule->getName()-|</legend>
			|-assign var=categories value=$selectedModule->getParentCategories()-|
			|-include file="DocumentsCategoriesTreeInclude.tpl" user=$user categories=$categories-|
			<br />
			<p><a href='Main.php?do=documentsList'>Mostrar todos las categorías disponibles</a></p>
		</fieldset>
	|-else-|
		<!--pedido de todos los módulos y categorías generales y documentos sin categorías -->
		<fieldset>
			<legend>Categorías Disponibles</legend>
			<p>Documentos sin categoría</p>
				<ul>
					<li>
						<a href="Main.php?do=documentsList&amp;categoryId=0">|-if $categoryId eq 0-|<strong>|-/if-|Documentos sin categoría (|-$documentsWithoutCategoryCount-|)|-if $categoryId eq 0-|</strong>|-/if-|</a>
					</li>
				</ul>
			<br />
			|-if $generalParentCategories|@count neq 0-|
				<p>Categorías Generales</p>
				|-include file="DocumentsCategoriesTreeInclude.tpl" user=$user categories=$generalParentCategories-|
			|-/if-|
			<br />
		|-foreach from=$modules item=module-|
				<p>Categorías en |-$module->getName()-|</p>
				|-assign var=categories value=$module->getParentCategories()-|
				|-include file="DocumentsCategoriesTreeInclude.tpl" user=$user categories=$categories-|
			</p>
		|-/foreach-|
		</fieldset>
	|-/if-|
</div>
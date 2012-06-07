|-extends file="CommonSearchEntityListX.tpl"-|
|-block name=entityType-|Headline|-/block-|
|-block name=title-|Titulares|-/block-|
|-block name=filters-|
	<label for="filters[fromDate]">Fecha desde</label>
	<input id="filters[fromDate]" name="filters[fromDate]" type="text" value="|-$filters.fromDate-|" size="12" title="Fecha desde" />
	<label for="filters[toDate]">Fecha hasta</label>
	<input id="filters[toDate]" name="filters[toDate]" type="text" value="|-$filters.toDate-|" size="12" title="Fecha hasta" />
|-/block-|
|-block name=entity-|
	<p>|-$entity-| <a href="Main.php?do=headlinesEdit&id=|-$entity->getId()-|" class="icon iconView inlineTable" target="_blank"></a></p>
|-/block-|
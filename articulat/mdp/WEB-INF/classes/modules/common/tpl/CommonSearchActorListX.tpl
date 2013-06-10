|-extends file="CommonSearchEntityListX.tpl"-|
|-block name=entityType-|Actor|-/block-|
|-block name=title-|Actores|-/block-|
|-block name=filters-||-/block-|
|-block name=entity-|
	<p>|-$entity-| <a href="Main.php?do=ActorsEdit&id=|-$entity->getId()-|" class="icon iconView inlineTable" target="_blank"></a></p>
|-/block-|
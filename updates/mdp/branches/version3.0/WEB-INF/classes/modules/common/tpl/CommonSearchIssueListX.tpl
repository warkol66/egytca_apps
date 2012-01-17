|-extends file="CommonSearchEntityListX.tpl"-|
|-block name=entityType-|Issue|-/block-|
|-block name=title-|Asuntos|-/block-|
|-block name=filters-||-/block-|
|-block name=entity-|
	<p>|-$entity-| <a href="Main.php?do=issuesEdit&id=|-$entity->getId()-|" class="icon iconView inlineTable" target="_blank"></a></p>
|-/block-|
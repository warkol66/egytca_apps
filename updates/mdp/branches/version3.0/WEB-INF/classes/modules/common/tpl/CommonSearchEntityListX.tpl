<h3>|-block name=title-||-/block-|</h3>
<p>
	<a href=# onclick="$('filters').show(); return false;">filtros</a>
</p>
<div id="filters" style="display:none">
	<form id="filters">
		|-block name=filters-||-/block-|
	</form>
	<button onclick="loadRelatedEntitiesContent('|-block name=entityType-||-/block-|', $('filters'));">Filtrar</button>
</div>
<div id="entities">
	|-foreach $entities as $entity-|
		|-block name=entity-||-/block-|
	|-/foreach-|
</div>
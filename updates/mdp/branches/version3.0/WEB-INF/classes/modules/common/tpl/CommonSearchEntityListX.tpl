<h3>|-block name=entityName-||-/block-|</h3>
<p>
	<a href=# onclick="$('filters').show(); return false;">filtros</a>
</p>
<div id="filters" style="display:none">
	|-block name=filters-||-/block-|
</div>
<div id="entities">
	|-foreach $collection as $entity-|
		|-block name=entity-||-/block-|
	|-/foreach-|
</div>
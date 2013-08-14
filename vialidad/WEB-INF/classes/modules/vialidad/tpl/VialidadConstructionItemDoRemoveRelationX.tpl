|-if $components->count() eq 0-|
<tr id="empty_table_message"><td colspan="2">No hay componentes que mostrar.</td></tr>
|-else-|

|-foreach from=$components item=component-|
|-include file="VialidadConstructionItemRelationTableRowInclude.tpl" component=$component item=$item-|
|-/foreach-|

|-/if-|
<script type="text/javascript">

var suppliesIds = new Array();
var totalProportion = 0;

		checkProportions(0);
		loadSuppliesIds();
		|-foreach from=$components item=component-|
		attachInPlaceEditor('|-$component->getSupplyid()-|', 'proportion|-$component->getSupplyid()-|')
		|-/foreach-|
		attachSupplyAutocompleter('new_supply1', 'div_autocomplete1');
</script>

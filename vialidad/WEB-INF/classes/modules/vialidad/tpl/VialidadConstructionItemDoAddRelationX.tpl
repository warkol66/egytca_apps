|-include file="VialidadConstructionItemRelationTableRowInclude.tpl" component=$component item=$item-|

<script type="text/javascript">

attachInPlaceEditor('|-$component->getSupplyid()-|', 'proportion|-$component->getSupplyid()-|');

if ($('empty_table_message'))
	$('empty_table_message').parentNode.removeChild($('empty_table_message'));

</script>
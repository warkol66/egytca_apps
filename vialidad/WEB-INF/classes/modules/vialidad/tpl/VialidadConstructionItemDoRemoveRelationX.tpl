|-if $components->count() eq 0-|
<tr id="empty_table_message"><td colspan="2">No hay componentes que mostrar.</td></tr>
|-else-|

|-foreach from=$components item=component-|
|-include file="VialidadConstructionItemRelationTableRowInclude.tpl" component=$component item=$item-|
|-/foreach-|

|-/if-|
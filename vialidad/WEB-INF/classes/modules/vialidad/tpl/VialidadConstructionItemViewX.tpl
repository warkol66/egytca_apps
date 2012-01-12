<script language="JavaScript" type="text/javascript">
	$('viewWorking').innerHTML = '';
</script>
<h2>Paramétricas</h2>
<h1>Administración de Items </h1>

|-assign var=construction value=$item->getConstruction()-|
  <table border="0" cellpadding="4" cellspacing="0" class="tableTdBorders"> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Contrato</td> 
      <td>|-$construction->getContract()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Obra</td> 
      <td>|-$item->getConstruction()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Nombre</td> 
      <td>|-$item->getName()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Código</td> 
      <td> |-$item->getCode()-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Cantidad</td> 
      <td>|-$item->getQuantity()|system_numeric_format-|</td> 
    </tr> 
     <tr> 
      <td width="20%" nowrap class="tdTitle">Unidad</td> 
      <td>|-$item->getUnit()-|</td> 
    </tr> 
   </table> 
<h3>Componentes</h3>
<div id="div_items"> 
	<table class='tableTdBorders' cellpadding='5' cellspacing='0'>
		<thead>
		</tr>
			<tr class="thFillTitle">
				<th width="65%">Insumo</th>
				<th width="35%">Proporción</th>
			</tr>
		</thead>
		<tbody id="components_table">
			|-if $components->count() eq 0-|
			<tr id="empty_table_message"><td colspan="2">No hay componentes que mostrar.</td></tr>
			|-else-|
				|-foreach from=$components item=component-|
				|-include file="VialidadConstructionItemRelationTableRowInclude.tpl" component=$component item=$item view=1-|
				|-/foreach-|
			|-/if-|
		</tbody>
	</table>
</div>






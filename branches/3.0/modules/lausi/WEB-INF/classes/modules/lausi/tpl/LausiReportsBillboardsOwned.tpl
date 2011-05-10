<h2>Reportes</h2>
<h1>Carteleras por Circuito.</h1>
<div id="billboardsCount">
|-foreach from=$circuits item=circuit-|
<table width="600" class="tableTdBorders">

	<thead>
		<tr>
			<td colspan="2"><h4>|-$circuit->getName()-|</h4></td>
			<td><a href="#" onClick="this.hide(); this.adjacent('a')[0].show(); this.parentNode.parentNode.parentNode.adjacent('tbody')[0].toggle(); return false">Mostrar Detalles</a><a href="#" onClick="this.hide(); this.adjacent('a')[0].show(); this.parentNode.parentNode.parentNode.adjacent('tbody')[0].toggle(); return false" style="display:none">Ocultar Detalles</a></td>
		<tr>
		<tr>
			<th width="80%" nowrap="nowrap">
				Dirección
			</th>
			<th width="10%" nowrap="nowrap">Dobles</th>				
			<th width="10%" nowrap="nowrap">Séxtuples</th>
		</tr>
	</thead>
	<tbody style="display:none">
		|-assign var=addresses value=$circuit->getAddresss()-|
		|-foreach from=$addresses item=address-|		
		<tr>
			<td>
				|-$address->getName()-|
			</td>
			<td>
				|-$address->getBillboardCountByType($typeDoble)-|
			</td>				
			<td>
				|-$address->getBillboardCountByType($typeSextuple)-|
			</td>
		</tr>
		|-/foreach-|
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3">
			</td>
		</tr>	
		<tr>
			<td>
				Totales
			</td>
			<td>
				|-$circuit->getBillboardsCount($typeDoble)-|
			</td>				
			<td>
				|-$circuit->getBillboardsCount($typeSextuple)-|
			</td>
		</tr>
	</tfoot>
</table>
<br />
|-/foreach-|

|-include file="LausiReportsPrintLinkInclude.tpl"-|

</div>
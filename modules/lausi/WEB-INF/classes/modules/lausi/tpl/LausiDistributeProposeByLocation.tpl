<script type="text/javascript" language="javascript">
// <![CDATA[
		$('msgbox').innerHTML = '<span class="resultSuccess">La Operación ha sido existosa.<span>';
// ]]>
</script>

<br />

|-foreach from=$results item=result name=for_result-|
	|- assign var=description value=$result.description-|
<form id="form01" method="post">

	<table id="tabla-addresses" width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
		<thead>
			<tr>
				 <th colspan="6" class="thFillTitle">|-$description-|</th>
			</tr>
		|-if empty($result.options)-|
		</thead>
		<tbody>
			<tr>
				 <th colspan="6" class="thFillTitle">No se han obtenido resultados</th>
			</tr>
		</tbody>
		|-else-|
			<tr>
				<th width="60%" colspan="2">Dirección</th>
<!--				<th width="10%">Número de Carteleras</th> -->
				<th width="40%">Ultimo Motivo</th>				
			</tr>
		</thead>
		<tbody>
		|-foreach from=$result.options item=byAddress name=for_byAddress-|
		|-if $byAddress eq 'Separator1'-|
			<tr class="thFillTitle"><td colspan="3">Resultados en un 30% más de radio (hasta |-math equation="x*1.3" x=$result.radius-| m)</td></tr>
			<tr  class="nopaddingCell">
		|-elseif $byAddress eq 'Separator2'-|	
			<tr class="thFillTitle"><td colspan="3">Resultados entre un 30% y un 60% más de radio (de |-math equation="x*1.3" x=$result.radius-| hasta |-math equation="x*1.6" x=$result.radius-| m)</td></tr>
			<tr  class="nopaddingCell">	
		|-elseif $byAddress eq 'Separator3'-|	
			<tr class="thFillTitle"><td colspan="3">Resultados entre un 60% y un 100% más de radio (de |-math equation="x*1.6" x=$result.radius-| hasta |-math equation="x*2" x=$result.radius-| m)</td></tr>
			<tr  class="nopaddingCell">	
		|-else-|
			|-assign var=address value=$byAddress.address-|
			<tr><td colspan="3">|-$address->getName()-| ( |-$byAddress.selected-| Seleccionadas / |-$byAddress.elements|@count-| Disponibles) [ <a href="javascript:switch_vis('div_|-$address->getId()-|')" class="edit">Editar</a> ]</td>	
			</tr>
			<tr  class="nopaddingCell">
			<td colspan="3" class="noPaddingCell">
				<div id="div_|-$address->getId()-|" style="display:none; margin:0; padding:0;">
				<table id="tabla-addresses|-$address->getName()-|" width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
			|-foreach from=$byAddress.elements item=billboard name=for_billboards-|			
				|-assign var=address value=$billboard->getAddress()-|
				<tr>
					<td width="2%" nowrap><input type="checkbox" name="toDistribute[]" |-if $billboard->isChecked() -|checked="checked"|-/if-| value="|-$billboard->getId()-|" onClick="var checkedsCount = $$('#div_|-$address->getId()-| input:checked').size();if (checkedsCount == 0) {distributionMap.markAvailable(|-$address->getId()-|)} else if (checkedsCount == |-$byAddress.elements|@count-|){distributionMap.markAssigned(|-$address->getId()-|)} else {distributionMap.markPartiallyAssigned(|-$address->getId()-|)}"/></td>
					<td width="60%">|-$address->getName()-|</td>
<!--					|-$billboard->getNumber()-|  -->
					<td width="38%">|-assign var=lastTheme value=$billboard->getLastTheme()-||-if $lastTheme neq false-||-$lastTheme->getName()-||-else-|-|-/if-|</td>				
				<tr>		
			|-/foreach-|
			</table>
		</div>
		</td>
		</tr>
		|-/if-|					
		|-/foreach-|						
			<tr> 
				<td colspan="6">
					<input type="hidden" name="themeId" value="|-$theme->getId()-|" />
					<input type="hidden" name="publishDate" value="|-$publishDate-|" />
					<input type="hidden" name="duration" value="|-$duration-|"/>
					<input type="hidden" name="do" value="lausiDoDistributeX" />
					<input type="hidden" name="formId" value="form01" />
					<p><input type="button" value="Realizar Asignaciones para |-$description-|" onClick="javascript:lausiDoDistribution(this.form)"/></p>
				</td> 
			</tr>							
		</tbody>
		|-/if-|
	</table>
</form>	
	<br />	
|-/foreach-|

|-include file="LausiDistributeProposeMapInclude.tpl"-|

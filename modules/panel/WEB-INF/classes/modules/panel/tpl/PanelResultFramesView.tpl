|-if !$result-|<h2>##common,18,Configuración del Sistema##</h2>
<h1>Marco de Resultados
<!-- /Link VOLVER -->
</h1>
|-else-|
<h1>Marco de Resultados</h1>
|-/if-|
<form action="Main.php" method="get" style="display:inline;">
|-*Opciones para llamado por Include*-|
|-if $result.policyGuidelines-||-assign var=policyGuidelines value=$result.policyGuidelines-||-/if-|
|-if $result.resultFrameIndicators-||-assign var=resultFrameIndicators value=$result.resultFrameIndicators-||-/if-|
|-if $result.selectedPolicyGuideline-||-assign var=selectedPolicyGuideline value=$result.selectedPolicyGuideline-||-/if-|
|-*/Opciones para llamado por Include*-|
<p>Seleccione Préstamo&nbsp;
	<select id="policyGuidelineId" name="policyGuidelineId" title="Préstamo"  onchange="this.form.submit();">
		<option value="0">Seleccione</option>
	|-foreach from=$policyGuidelines item=policyGuideline name=for_policyGuidelines-|
		<option value="|-$policyGuideline->getId()-|" |-$policyGuideline->getId()|selected:$selectedPolicyGuideline->getId()-|>|-$policyGuideline->getName()-|</option>
	|-/foreach-|
	</select></p>
	<input type="hidden" name="do" value="panelResultFramesView" />
</form>
|-if $resultFrameIndicators|@count gt 0-|
|-assign var=policyGuidelineObj value=$selectedPolicyGuideline->getObject()-|
|-assign var=startingYear value=$policyGuidelineObj->getStartingYear()-|
|-assign var=endingYear value=$policyGuidelineObj->getEndingYear()-|
|-math equation="x - y + 1" x=$endingYear y=$startingYear assign="span"-|
|-math equation="x + y" x=$span y=9 assign="colspan"-|
<div id="div_resultFrameIndicators">
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders nestedTable' id="tabla-resultFrameIndicators">
		<thead>
			<tr class="thFillTitle">
				<th width="55%" rowspan="2">Indicadores de resultado</th>
				<th width="5%" rowspan="2">Situación</th>
				<th colspan="|-$span-|">Valores Objetivo</th>
				<th colspan="3">Recolección de datos e Informe</th>
				<th width="5%" rowspan="2">&nbsp;</th>
			</tr>
			<tr class="thFillTitle">
				|-section name=yearSpan loop=$span-|<th width="5%">|-math equation="x + y" x=$startingYear y=$smarty.section.yearSpan.index-|</th>|-/section-|
				<th width="5%">Frecuencia e informes</th>
				<th width="5%">Instrumentos de recolección de datos</th>
				<th width="5%">Responsabilidad de recolección de datos</th>
			</tr>
		</thead>
		<tbody>
		|-if $resultFrameIndicators|@count eq 0-|
			<tr>
				 <td colspan="5">|-if isset($filters)-|No hay indicadores que concuerden con la búsqueda|-else-|No hay indicadores disponibles|-/if-|</td>
			</tr>
		|-else-|
		|-assign var=lastIndicatorObjectType value=$selectedPolicyGuideline->getObjectType()-|
			|-foreach from=$resultFrameIndicators item=resultFrameIndicator name=for_positions-|
			|-if $resultFrameIndicator->getObject() ne $lastIndicatorObject-|
				<tr>
					<th colspan="|-$colspan-|">|-assign var=relatedTo value=$resultFrameIndicator->getObject()-||-$relatedTo->getName()-|</th>
				</tr>
			|-/if-|
			|-if $resultFrameIndicator->getUseData()-|
				<tr>
					<td rowspan="2">|-$resultFrameIndicator->getName()-|</td>
					<td>meta</td>
				|-assign var=indicatorValues value=$resultFrameIndicator->getValues()-|
				|-foreach from=$indicatorValues item=indicatorValue-|
					<td>
						|-$indicatorValue->getGoal()-|
					</td>
				|-/foreach-|
					<td rowspan="2">|-if $resultFrameIndicator->getFrequency() eq 1-|Anual|-elseif $resultFrameIndicator->getFrequency() eq 2-|Semestral|-elseif $resultFrameIndicator->getFrequency() eq 3-|Trimestral|-/if-|</td>
					<td rowspan="2">|-$resultFrameIndicator->getDataRecolectionInstrument()-|</td>
					<td rowspan="2">|-$resultFrameIndicator->getDataRecolectionResponsible()-|</td>
					<td rowspan="2" nowrap>|-if !$result-|
						<form action="Main.php" method="get" style="display:inline;">
							|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
							|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
							<input type="hidden" name="do" value="panelResultFramesIndicatorsEdit" />
							<input type="hidden" name="from" value="panelResultFramesView" />
							<input type="hidden" name="policyGuidelineId" value="|-$selectedPolicyGuideline->getId()-|" />
							<input type="hidden" name="id" value="|-$resultFrameIndicator->getid()-|" />
							<input type="submit" name="submit_go_edit_indicator" value="Editar" class="iconEdit" />
						</form>
						<form action="Main.php" method="get" style="display:inline;">
							|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
							|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
							<input type="hidden" name="do" value="panelResultFramesIndicatorsEdit" />
							<input type="hidden" name="from" value="panelResultFramesView" />
							<input type="hidden" name="policyGuidelineId" value="|-$selectedPolicyGuideline->getId()-|" />
							<input type="submit" name="submit_go_edit_indicator" value="Editar" class="iconAdd" />
						</form>
						<form action="Main.php" method="post" style="display:inline;">
							|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
							|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
							<input type="hidden" name="do" value="panelResultFramesIndicatorsDoDelete" />
							<input type="hidden" name="id" value="|-$resultFrameIndicator->getid()-|" />
							<input type="submit" name="submit_go_delete_indicator" value="Borrar" onclick="return confirm('Seguro que desea eliminar la indicador?')" class="iconDelete" />
						</form>
						|-if $resultFrameIndicator->countChildren() > 1 -|
						<form action="Main.php" method="post" style="display:inline;">
							<input type="hidden" name="do" value="commonNestedSetOrderByParent" />
							<input type="hidden" name="entity" value="ResultFrameIndicator" />
							<input type="hidden" name="nodeId" value="|-$resultFrameIndicator->getid()-|" />
							<input type="submit" name="submit_go_order_sibblings" value="Ordenar Hijos" class="iconOrder" />
						</form>
						|-/if-|				|-/if-|	</td>				</tr>
				<tr>
					<td>resultado</td>
				|-foreach from=$indicatorValues item=indicatorValue-|
					<td>
						|-$indicatorValue->getValue()-|
					</td>
				|-/foreach-|
				</tr>
			|-else *No usa datos*-|
				<tr>
					<td>|-$resultFrameIndicator->getName()-|</td>
					<td colspan="|-$span+4-|">&nbsp;
						
					</td>
					<td nowrap>|-if !$result-|
						<form action="Main.php" method="get" style="display:inline;">
							|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
							|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
							<input type="hidden" name="do" value="panelResultFramesIndicatorsEdit" />
							<input type="hidden" name="from" value="panelResultFramesView" />
							<input type="hidden" name="policyGuidelineId" value="|-$selectedPolicyGuideline->getId()-|" />
							<input type="hidden" name="id" value="|-$resultFrameIndicator->getid()-|" />
							<input type="submit" name="submit_go_edit_indicator" value="Editar" class="iconEdit" />
						</form>
						<form action="Main.php" method="get" style="display:inline;">
							|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
							|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
							<input type="hidden" name="do" value="panelResultFramesIndicatorsEdit" />
							<input type="hidden" name="from" value="panelResultFramesView" />
							<input type="hidden" name="policyGuidelineId" value="|-$selectedPolicyGuideline->getId()-|" />
							<input type="submit" name="submit_go_edit_indicator" value="Editar" class="iconAdd" />
						</form>
						<form action="Main.php" method="post" style="display:inline;">
							|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
							|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
							<input type="hidden" name="do" value="panelResultFramesIndicatorsDoDelete" />
							<input type="hidden" name="id" value="|-$resultFrameIndicator->getid()-|" />
							<input type="submit" name="submit_go_delete_indicator" value="Borrar" onclick="return confirm('Seguro que desea eliminar la indicador?')" class="iconDelete" />
						</form>
						|-if $resultFrameIndicator->countChildren() > 1 -|
						<form action="Main.php" method="post" style="display:inline;">
							<input type="hidden" name="do" value="commonNestedSetOrderByParent" />
							<input type="hidden" name="entity" value="ResultFrameIndicator" />
							<input type="hidden" name="nodeId" value="|-$resultFrameIndicator->getid()-|" />
							<input type="submit" name="submit_go_order_sibblings" value="Ordenar Hijos" class="iconOrder" />
						</form>
						|-/if-|
						|-/if-|
						</td>
				</tr>
			|-/if-|
			|-assign var=lastIndicatorObject value=$resultFrameIndicator->getObject()-|
			|-/foreach-|						
		|-/if-|
		</tbody>
	</table>
</div>
|-/if-|

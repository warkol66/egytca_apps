<h2>Tablero de Gestión|-if $moduleConfig.useDependencies.value eq "YES"-||-if $loginUser-| - <a href="Main.php?do=tableroDependenciesShow">Dependencias</a> > |-/if-|
	<a href="Main.php?do=tableroObjectivesShow|-if $loginUser-|&dependencyId=|-$dependency->getId()-||-/if-|">|-$dependency->getName()-|</a> |-/if-| > 
	<a href="Main.php?do=tableroProjectsShow&objectiveId=|-$objective->getid()-|">|-$objective->getName()-|</a> > 
	|-$project->getName()-|</h2>
<h1>Indicadores del Proyecto</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación se muestra la lista de Indicadores del Proyecto.</p>
<div id="div_milestones">
	<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-milestones">
		<thead>
			<tr>
				 <th colspan="5" class="thFillTitle">Hitos</th>
			</tr>
			<tr>
				 <th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroMilestonesEdit&projectId=|-$project->getId()-|&show=1" class="addNew">Agregar Hito al Proyecto</a></div></th>
			</tr>
			<tr>
					<th width="5%" class="thFillTitle">Id</th>
				<th width="75%" class="thFillTitle">Nombre</th>
				<th width="10%" class="thFillTitle">Vencimiento</th>
				<th width="5%" class="thFillTitle">Terminado</th>
				<th width="5%" class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$milestones item=milestone name=for_milestones-|
			<tr>
				<td class="line1">|-$milestone->getid()-|</td>
				<td class="line1">|-$milestone->getname()-|</td>
				<td class="line1" align="center">|-$milestone->getexpirationDate()|date_format:"%d-%m-%Y"-|</td>
				<td class="line1" align="center">|-if $milestone->getcompleted() eq 0-|No|-else-|Si|-/if-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="tableroMilestonesEdit" />
						<input type="hidden" name="id" value="|-$milestone->getid()-|" />
						<input type="submit" name="submit_go_edit_milestone" value="Editar" class="buttonImageEdit" />
						<input type="hidden" name="show" value="1" />																				
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="tableroMilestonesDoDelete" />
						<input type="hidden" name="id" value="|-$milestone->getid()-|" />
						<input type="submit" name="submit_go_delete_milestone" value="Borrar" onclick="return confirm('Seguro que desea eliminar el milestone?')" class="buttonImageDelete" />
						<input type="hidden" name="show" value="1" />																				
					</form>				</td>
			</tr>
		|-/foreach-|						
		</tbody>
	</table>
</div>
<p>&nbsp;</p>
<div id="div_indicators">
	<table width='100%' border="0" cellpadding='5' cellspacing='0'  class='tableTdBorders' id="tabla-indicators">
		<thead>
			<tr>
				 <th colspan="7" class="thFillTitle">Indicadores</th>
			</tr>
			<tr>
				 <th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroIndicatorsEdit&projectId=|-$project->getId()-|&show=1" class="addNew">Agregar Indicador al Proyecto</a></div></th>
			</tr>
			<tr>
				<th width="65%" class="thFillTitle">Nombre de Indicador</th>
				<th width="5%" class="thFillTitle">Fecha Expiración</th>
				<th width="5%" class="thFillTitle">Iniciado</th>
				<th width="5%" class="thFillTitle">Fecha de Inicio</th>
				<th width="5%" class="thFillTitle">Fecha de Fin</th>
				<th width="10%" class="thFillTitle">Progreso Actual</th>
				<th width="5%" class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $indicators|@count lt 1-|
			<tr>
				 <td colspan="7">No hay indicadores asociados al proyecto</td>
			</tr>
		|-else-|
		|-foreach from=$indicators item=indicator name=for_indicators-|
			<tr>															
				<td class="line1">|-$indicator->getname()-|</td>
				<td align="center" class="line1">|-$indicator->getexpirationDate()|date_format:"%d-%m-%Y"-|</td>
				<td align="center" class="line1">|-if $indicator->getstarted() eq 0-|No|-else-|Si|-/if-|</td>
				<td align="center" class="line1">|-$indicator->getstartDate()|date_format:"%d-%m-%Y"-|</td>
				<td align="center" class="line1">|-$indicator->getendDate()|date_format:"%d-%m-%Y"-|</td>
				<td align="center" class="line1">|-$indicator->getactualProgress()-|</td>
				<td nowrap>																
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="tableroIndicatorsEdit" />
						<input type="hidden" name="id" value="|-$indicator->getid()-|" />
						<input type="submit" name="submit_go_edit_indicator" value="Editar" class="buttonImageEdit" />
						<input type="hidden" name="show" value="1" />																				
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="tableroIndicatorsDoDelete" />
						<input type="hidden" name="id" value="|-$indicator->getid()-|" />
						<input type="submit" name="submit_go_delete_indicator" value="Borrar" onclick="return confirm('Seguro que desea eliminar el indicator?')" class="buttonImageDelete" />
						<input type="hidden" name="show" value="1" />																				
					</form>								</td>
			</tr>
			<tr >
				<td colspan="7">
				<p>
					<h4>Mediciones del Indicador</h4>
					<ul>
						|-assign var=measures value=$indicator->getTableroMeasures()-|
						|-foreach from=$measures item=measure name=for_measures-|
						<li>Fecha: |-$measure->getMeasureDate()-| - Valor: |-$measure->getMeasureNumber()-| - Valor Esperado: |-$measure->getMeasureExpectedNumber()-|
							<form action="Main.php" method="get">
								<input type="hidden" name="do" value="tableroMeasuresEdit" />
								<input type="hidden" name="id" value="|-$measure->getid()-|" />
								<input type="submit" name="submit_go_edit_measure" value="Editar Medición" />
								<input type="hidden" name="show" value="1" />																				
							</form>
						</li>
						|-/foreach-|
					</ul>
				</p>
				</td>
			</tr>
		|-/foreach-|						
		|-/if-|
		</tbody>
	</table>
</div>
|-if $moduleConfig.useCommunes.value == "YES"-|
<div id="div_communes">
	<h4>Comunas Afectadas por el Proyecto</h4>
		<ul id="communeList">
			|-foreach from=$actualCommunes item=communeRel name=for_commune-|
			|-assign var=commune value=$communeRel->getTableroCommune()-|
			<li id="communeListItem|-$commune->getId()-|">
				|-$commune->getName()-|
			</li>            	
			|-/foreach-|
		</ul>
</div>
|-/if-|
|-if $moduleConfig.useRegions.value == "YES"-|
<div id="div_regions">
	<h4>Barrios Afectados por el Proyecto</h4>
	<ul>
	|-foreach from=$actualRegions item=regionRel name=for_region-|
		|-assign var=region value=$regionRel->getTableroRegion()-|
		<li id="regionListItem|-$region->getId()-|">|-$region->getName()-|
		</li>                	
	|-/foreach-|
	</ul>
</div>
|-/if-|

<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Versiones de Organigrama
<!-- /Link VOLVER -->
</h1>

<p>A continuación podrá editar las versiones de organigrama.</p>
<div id="div_positions_versions">
	|-if $message eq "ok"-|
		<div class="successMessage">Versión guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Versión eliminada correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-positions-versions">
		<thead>
			<tr>
				 <th colspan="4" class="thFillTitle">
				 	<div class="rightLink"><a href="Main.php?do=positionsVersionsEdit" class="addNew">Agregar Versión</a></div>
				</th>
			</tr>
			<tr class="thFillTitle">
				<th width="10%">Versión</th>
				<th width="40%">Desde</th>
				<th width="40%">Hasta</th>
				<th width="10%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $versions|@count eq 0-|
			<tr>
				 <td colspan="5">No hay versiones disponibles</td>
			</tr>
		|-else-|
			|-foreach from=$versions item=version name=for_versions-|
			<tr>
				<td>|-$version->getId()-|</td>
				<td>|-$version->getDateFrom()|date_format:"%d-%m-%Y"-|</td>
				<td>|-$version->getDateTo()|date_format:"%d-%m-%Y"-|</td>
				<td nowrap>
					<a href="Main.php?do=positionsList&version=|-$version->getId()-|">Positions</a>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="positionsVersionsEdit" />
						<input type="hidden" name="id" value="|-$version->getId()-|" />
						<input type="submit" name="submit_go_edit_position_version" value="Editar" class="buttonImageEdit" />
					</form>
				</td>
			</tr>
			|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|7|-else-|6|-/if-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>
		|-/if-|
			<tr>
				 <th colspan="5" class="thFillTitle">|-if $versions|@count gt 5-|<div class="rightLink"><a href="Main.php?do=positionsVersionsEdit" class="addNew">Agregar Versión</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody>
	</table>
</div>


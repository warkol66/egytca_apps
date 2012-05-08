|-if !$result-|<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Versiones de Reporte
<!-- /Link VOLVER -->
</h1>
<p>A continuación podrá editar las versiones de reporte.</p>
|-else-|
|-assign var=versions value=$result-|
<h1>Reportes Semestrales</h1>
|-/if-|
<div id="div_reports_versions">
	|-if $message eq "ok"-|
		<div class="successMessage">Versión guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Versión eliminada correctamente</div>
	|-elseif $message eq "error"-|
		<div class="errorMessage">Ocurrió un error al guardar la version.</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-reports-versions">
		<thead>
|-if !$result-|			<tr>
				 <th colspan="4" class="thFillTitle">
				 	<div class="rightLink"><a href="Main.php?do=panelReportsVersionsEdit" class="addLink">Agregar Versión</a></div>
				</th>
			</tr>
|-/if-|			<tr class="thFillTitle">
				<th width="60%">Reporte</th>
				<th width="10%">Desde</th>
				<th width="10%">Hasta</th>
				<th width="20%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $versions|@count eq 0-|
			<tr>
				 <td colspan="4">No hay versiones disponibles</td>
			</tr>
		|-else-|
			|-foreach from=$versions item=version name=for_versions-|
			<tr>
				<td>|-$version->getName()-|</td>
				<td>|-$version->getDateFrom()|date_format:"%d-%m-%Y"-|</td>
				<td>|-$version->getDateTo()|date_format:"%d-%m-%Y"-|</td>
				<td nowrap>
					<a href="Main.php?do=panelReportsSectionsList&version=|-$version->getId()-|" class="follow">Ir a secciones de Reporte</a>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="panelReportsVersionsEdit" />
						<input type="hidden" name="id" value="|-$version->getId()-|" />
						<input type="submit" name="submit_go_edit_report_version" value="Editar" title="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="panelReportsVersionsDoExport" />
						<input type="hidden" name="versionId" value="|-$version->getId()-|" />
						<input type="submit" name="submit_go_export_report_version" value="Exportar" title="Exportar" class='buttonImageDownload' />
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="panelReportsVersionsDoDelete" />
						<input type="hidden" name="versionId" value="|-$version->getId()-|" />
						<input type="submit" name="submit_go_delete_version" value="Borrar" onclick="return confirm('Seguro que desea eliminar completamente la versión?')" class="icon iconDelete" />
					</form>
				</td>
			</tr>
			|-/foreach-|						
		|-if !$result && $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="4" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>
		|-/if-|
|-if !$result-|				<tr>
				 <th colspan="4" class="thFillTitle">|-if $versions|@count gt 5-|<div class="rightLink"><a href="Main.php?do=panelReportsVersionsEdit" class="addLink">Agregar Versión</a></div>|-/if-|</th>
			</tr>|-/if-|
		|-/if-|
		</tbody>
	</table>
</div>


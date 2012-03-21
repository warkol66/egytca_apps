<h2>Módulo de Encuestas</h2>
<h1>Listado de Encuestas</h1>
<div id="div_surveys">
<p>A continuación tiene el listado de encuestas disponibles en el sistema.</p>
	|-if $message eq "ok"-|
		<div class="resultSuccess">Encuesta guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="resultSuccess">Encuesta eliminada correctamente</div>
	|-/if-|
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableTdBorders" id="tabla-surveys">
	<col width="40%">
	<col width="20%">
	<col width="10%">
	<col width="10%">
	<col width="10%">
	<col width="10%">
		<thead>
			<tr>
				<th colspan="|-if !$configModule->get("surveys","productSurveys")-|6|-else-|5|-/if-|">
					<div class="rightLink"><a href="Main.php?do=|-if $configModule->get("surveys","productSurveys")-|surveysGenerateProductsSurvey|-else-|surveysEdit|-/if-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Encuesta</a></div>
				</th>
			</tr>
			<tr>
				<th>Nombre</th>
				|-if !$configModule->get("surveys","productSurveys")-|<th>Visibilidad</th>|-/if-|
				<th>Creada</th>
				<th>Inicia</th>
				<th>Termina</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$surveys item=survey name=for_surveys-|
			<tr>
				<td>|-$survey->getname()-|</td>
				|-if !$configModule->get("surveys","productSurveys")-|<td>|-if $survey->isPublic()-|Pública|-else-|Usuarios Registrados|-/if-|</td>|-/if-|
				<td>|-$survey->getcreatedAt()|date_format:"%d-%m-%Y"-|</td>
				<td>|-$survey->getstartDate()|date_format:"%d-%m-%Y"-|</td>
				<td>|-$survey->getendDate()|date_format:"%d-%m-%Y"-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="surveysEdit" />
						<input type="hidden" name="id" value="|-$survey->getid()-|" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="submit" name="submit_go_edit_survey" value="Editar" title="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="surveysResults" />
						<input type="hidden" name="id" value="|-$survey->getid()-|" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="submit" name="submit_go_view_survey" value="Ver Gráfico" title="Ver Gráfico" class="icon iconViewGantt" />
					</form>	
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="surveysAnswersExport" />
						<input type="hidden" name="id" value="|-$survey->getid()-|" />
						<input type="submit" name="submit_go_view_survey" value="Exportar Resultados" title="Exportar Resultados" class="icon iconDownload" />
					</form>																	
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="surveysDoDelete" />
						<input type="hidden" name="id" value="|-$survey->getid()-|" />
					|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
					|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="submit" name="submit_go_delete_survey" value="Eliminar" title="Eliminar" onclick="return confirm('Seguro que desea eliminar la encuesta?')" class="icon iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="|-if !$configModule->get("surveys","productSurveys")-|6|-else-|5|-/if-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|		
			<tr>
				<th colspan="|-if !$configModule->get("surveys","productSurveys")-|6|-else-|5|-/if-|">
					<div class="rightLink"><a href="Main.php?do=|-if $configModule->get("surveys","productSurveys")-|surveysGenerateProductsSurvey|-else-|surveysEdit|-/if-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Encuesta</a></div>
				</th>
			</tr>
		</tbody>
	</table>
</div>

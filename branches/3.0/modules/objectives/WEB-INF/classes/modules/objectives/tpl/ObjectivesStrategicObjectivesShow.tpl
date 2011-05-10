<h2>Tablero de Gestión|-if $moduleConfig.useDependencies.value eq "YES"-||-if $loginUser-| - <a href="Main.php?do=tableroDependenciesShow">Dependencias</a> > |-/if-|
	|-$dependency->getName()-||-/if-|</h2>
<h1>Administración de Objetivos</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Objetivos.</p>
<div id="div_objectives">
	|-if $message eq "ok"-|
		<div class="successMessage">Objetivo guardado correctamente.</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Objetivo eliminado correctamente.</div>
	|-/if-|
	<table id="tabla-objectives" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
		<thead>
			<tr>
				<th width="70%" class="thFillTitle">Objetivo</th>																
				<th width="10%" class="thFillTitle">Fecha</th>
				<th width="10%" class="thFillTitle">Fecha de Vencimiento </th>
				<th width="5%" class="thFillTitle">Terminado</th>
				<th width="5%" class="thFillTitle">&nbsp;</th>															
			</tr>
		</thead>
		<tbody>
		|-foreach from=$objectives item=objective name=for_objectives-|
			<tr>
				<td><a href="Main.php?do=tableroProjectsShow&objectiveId=|-$objective->getid()-|" class="detail">|-$objective->getname()-|</a></td>
				<td align="center" nowrap>|-$objective->getdate()|date_format:"%d-%m-%Y"-|</td>
				<td align="center" nowrap>|-$objective->getexpirationDate()|date_format:"%d-%m-%Y"-|</td>
				<td align="center">|-if $objective->getachieved() eq 0-|No|-/if-||-if $objective->getachieved() eq 1-|Si|-/if-|</td>
				<td nowrap><form action="Main.php" method="get" style="display:inline;">
							<input type="hidden" name="do" value="tableroProjectsShow" />
								<input type="hidden" name="objectiveId" value="|-$objective->getid()-|" />
								<input type="submit" name="submit_go_view_objective" value="Ver Proyectos" class="buttonImageView" />
						</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="tableroObjectivesEdit" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit_objective" value="Editar" class="buttonImageEdit" />
						<input type="hidden" name="show" value="1" />																				
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="tableroObjectivesDoDelete" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_delete_objective" value="Borrar" onclick="return confirm('Seguro que desea eliminar el objective?')" class="buttonImageDelete" />
						<input type="hidden" name="show" value="1" />																				
				</form>								</td>
			</tr>
		|-/foreach-|						
			<tr> 
				<td colspan="5" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		</tbody>
	</table>
</div>

<h2>Tablero de Control|-if $moduleConfig.useDependencies.value eq "YES"-||-if $loginUser-| - <a href="Main.php?do=tableroDependenciesShow">Dependencias</a> > |-/if-|
 <a href="Main.php?do=tableroObjectivesShow|-if $loginUser-|&dependencyId=|-$dependency->getId()-||-/if-|">|-$dependency->getName()-|</a>
 > |-else-| - <a href="Main.php?do=tableroObjectivesShow|-if $loginUser-|&dependencyId=|-$dependency->getId()-||-/if-|">Objetivos</a> > |-/if-| |-$objective->getName()-|
</h2>
<h1>Proyectos</h1>
<div id="div_projects"> 
|-if $message eq "ok"-|
	<div class="successMessage">Project guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Projecto eliminado correctamente</div>
|-/if-|
	<table id="tabla-projects" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'> 
		<thead> 
			<tr> 
				<th width="5%" class="thFillTitle">Id</th> 
				<th width="75%" class="thFillTitle">Nombre del Proyecto<h> 
				<th width="5%" class="thFillTitle">Vencimiento</th> 
				<th width="5%" class="thFillTitle">Terminado</th> 
				<th width="5%" class="thFillTitle">Progreso</th> 
				<th width="5%" class="thFillTitle">&nbsp;</th> 
			</tr> 
		</thead> 
		<tbody>  |-foreach from=$projects item=project name=for_projects-|
		<tr> 
			<td>|-$project->getId()-|</td> 
			<td><a href="Main.php?do=tableroProjectsDetailsShow&projectId=|-$project->getId()-|">|-$project->getName()-|</a></td> 
			<td align="center">|-$project->getGoalExpirationDate()|date_format-|</td> 
			<td align="center">|-$project->getFinished()-|</td> 
			<td align="center">|-$project->getGoalProgress()-|</td> 
			<td nowrap><form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroProjectsDetailsShow" /> 
					<input type="hidden" name="projectId" value="|-$project->getId()-|" /> 
					<input type="submit" name="submit_go_delete_project" value="Ver Detalles" class="icon iconView" /> 
				</form>
				<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroProjectsEdit" /> 
					<input type="hidden" name="id" value="|-$project->getId()-|" /> 
					<input type="submit" name="submit_go_edit_project" value="Editar" class="icon iconEdit" /> 
					<input type="hidden" name="show" value="1" /> 
				</form> 
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroProjectsDoDelete" /> 
					<input type="hidden" name="id" value="|-$project->getId()-|" /> 
					<input type="submit" name="submit_go_delete_project" value="Borrar" onclick="return confirm('Seguro que desea eliminar el project?')" class="icon iconDelete" /> 
					<input type="hidden" name="show" value="1" /> 
				</form> 
			</td> 
		</tr> 
		|-/foreach-|
		</tbody> 
		 </table> 
</div>

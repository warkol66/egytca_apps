<h2>Tablero de Gestión|-if $moduleConfig.useDependencies.value eq "YES"-||-if $loginUser-| - <a href="Main.php?do=tableroDependenciesShow">Dependencias</a> > |-/if-|
 <a href="Main.php?do=tableroObjectivesShow|-if $loginUser-|&dependencyId=|-$dependency->getId()-||-/if-|">|-$dependency->getName()-|</a>
 > |-else-| - <a href="Main.php?do=tableroObjectivesShow|-if $loginUser-|&dependencyId=|-$dependency->getId()-||-/if-|">Objetivos</a> > |-/if-| |-$objective->getName()-|
</h2>
<h1>Procesos</h1>
<div id="div_processes"> 
|-if $message eq "ok"-|
	<div class="successMessage">Proceso guardado correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Proceso eliminado correctamente</div>
|-/if-|
	<table id="tabla-processes" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'> 
		<thead> 
			<tr> 
				<th width="5%" class="thFillTitle">Id</th> 
				<th width="75%" class="thFillTitle">Nombre del Proceso<h> 
				<th width="5%" class="thFillTitle">Vencimiento</th> 
				<th width="5%" class="thFillTitle">Terminado</th> 
				<th width="5%" class="thFillTitle">Progreso</th> 
				<th width="5%" class="thFillTitle">&nbsp;</th> 
			</tr> 
		</thead> 
		<tbody>  |-foreach from=$processes item=process name=for_processes-|
		<tr> 
			<td>|-$process->getId()-|</td> 
			<td><a href="Main.php?do=tableroProcessesDetailsShow&processId=|-$process->getId()-|">|-$process->getName()-|</a></td> 
			<td align="center">|-$process->getGoalExpirationDate()|date_format-|</td> 
			<td align="center">|-$process->getFinished()-|</td> 
			<td align="center">|-$process->getGoalProgress()-|</td> 
			<td nowrap><form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroProcessesDetailsShow" /> 
					<input type="hidden" name="processId" value="|-$process->getId()-|" /> 
					<input type="submit" name="submit_go_delete_process" value="Ver Detalles" class="buttonImageView" /> 
				</form>
				<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroProcessesEdit" /> 
					<input type="hidden" name="id" value="|-$process->getId()-|" /> 
					<input type="submit" name="submit_go_edit_process" value="Editar" class="buttonImageEdit" /> 
					<input type="hidden" name="show" value="1" /> 
				</form> 
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroProcessesDoDelete" /> 
					<input type="hidden" name="id" value="|-$process->getId()-|" /> 
					<input type="submit" name="submit_go_delete_process" value="Borrar" onclick="return confirm('Seguro que desea eliminar el proceso?')" class="buttonImageDelete" /> 
					<input type="hidden" name="show" value="1" /> 
				</form> 
			</td> 
		</tr> 
		|-/foreach-|
		</tbody> 
	</table> 
</div>

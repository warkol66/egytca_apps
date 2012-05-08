|-if isset($show)-|
<h3>
	<a href="Main.php?do=objectivesShow">|-$dependency->getName()-|</a> > 
		<form id="objectiveForm" action="Main.php" method="get"><input type="hidden" name="do" value="projectsShow" / >																
			<input type="hidden" name="objectiveId" value="|-$objective->getid()-|" />
			<a href="#" onClick="$('objectiveForm').submit()">|-$objective->getName()-|</a>
		</form> > 
	|-$project->getName()-|
 </h3>
|-else-|
<h2>Tablero de Gestión</h2>
<h1>Administración de Actividades</h1>
|-/if-|

|-if $action eq "showLog"-|
	<div id="tabsLogs" class="tabs">
		|-include file="ProjectsActivitiesLogTabs.tpl"-|
	</div>
|-/if-|

<div id="div_activity">
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar la actividad</span>|-/if-|
		
		|-if $action ne "showLog"-|
			<h3>|-if $action eq 'edit'-|Edit|-else-|Create|-/if-| Actividad</h3>
			<p>Ingrese los datos de la Actividad.</p>
			<p>
				<a href="#" onClick="javascript:history.go(-1)">Volver atras</a>
			</p>
		|-/if-|
		
		
		|-include file="ProjectsActivitiesForm.tpl"-|
</div>
<!-- Manejo de documentos -->
|-if ($configModule->get("projectsActivities","useDocuments"))-|
	|-include file="DocumentsListInclude.tpl" entity="Activity" entityId=$activity->getId()-|
	|-include file="DocumentsEditInclude.tpl" entity="ProjectActivity" entityId=$activity->getId()-|
|-/if-| 
<!-- Fin manejo de documentos -->

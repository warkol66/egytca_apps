<h2>Proyectos</h2>
<h1>Orden de proyectos del objetivo</h1>
<p>A continuación encontrará los proyectos que se incluyen en el objetivo "|-$objective->getName()-|". Puede con este formulario determinar el orden de un proyecto versus los demás.</p>
<div id="orderChanged"></div>
	<fieldset title="Orenar proyectos">
		<legend>Orden de proyectos en el objetivo</legend>
		<ul id="projectsList">
		|-foreach from=$projects item=project name=for_projects-|
			<li id="projectList_|-$project->getId()-|" class="contentLi">
				<span class="textOptionMove" style="float:left;" title="Mover este proyecto">|-$project->getName()-|</span><br style="clear: all" />

			</li>
		|-/foreach-|
	</ul>
</fieldset>
 	<script type="text/javascript">
   Sortable.create("projectsList", {
		onUpdate: function() {  
				$('orderChanged').innerHTML = "<span class='inProgress'>Cambiando orden...</span>";
				new Ajax.Updater("orderChanged", "Main.php?do=projectsDoOrderByObjectiveX",
					{
						method: "post",  
						parameters: { objectiveId: "|-$objectiveId-|", data: Sortable.serialize("projectsList") }
					});
				} 
			});
 </script>
<p><input type="button" onclick="location.href='Main.php?do=objectivesList';" value="Regresar" /></p>
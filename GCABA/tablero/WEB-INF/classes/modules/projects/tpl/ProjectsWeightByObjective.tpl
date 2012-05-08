<script type="text/javascript">
	function checkPercent() {
		var totalWeight = 0;
		var weight;
		$$(".weightable").each(function(e) {
			weight = e.value.gsub('-', '');
			weight = weight.gsub(',', '.');
			var weightNumber = new Number(weight);
			weight = weightNumber.toFixed(|-$numberOfDecimals-|);
			totalWeight +=  parseFloat(weight);
			e.value = weight.toString().gsub('.', '|-$decimalSeparator-|');
        });
		if (totalWeight == 100){
        	$("submit").enable();
		} else {
			$("submit").disable();
		}
		updateStatusDisplay(totalWeight);
	}
	function updateStatusDisplay(totalWeight) {
		$$(".weightStatusDisplay").each(function(e) {
			e.innerHTML = totalWeight.toString().gsub('.', '|-$decimalSeparator-|');
        });
	}
</script>

<h2>Proyectos</h2>
<h1>Ponderación de proyectos del objetivo</h1>
<p>A continuación encontrará los proyectos que se incluyen en el objetivo "|-$objective->getName()-|". Puede con este formulario determinar la proporcion del objetivo que se consigue con cada proyecto.<br /> 
	Para guardar los cambios haga click en "Guardar".</p>
<p>Se ha asignado el <span class="weightStatusDisplay">|-$totalWeight-|</span>% del peso total del objetivo. Para guardar los cambios debe asignar exactamente 100%<p>
<form action="Main.php" method="post" name="form1">
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-bannerzoneweight">
		<tr>
			<th>Proyecto</th>
			<th>Peso</th>
		</tr>
		|-foreach from=$projects item=project name=for_projects-|
		<tr>
			<td>|-$project->getName()-|</td>
			<td><input name="projects[|-$smarty.foreach.for_projects.index-|][id]" type="hidden" value="|-$project->getId()-|" />
				<input type="text" class="weightable" name="projects[|-$smarty.foreach.for_projects.index-|][weight]" value="|-$project->getWeight()|system_numeric_format-|" size="5" onChange="checkPercent()"/>
			</td>
		</tr>
		|-/foreach-|
		<tr>
			<td colspan="2">
				<input id="submit" type="submit" value="##5,Guardar##" />
				<input type="button" value="##6,Regresar##" onClick="history.go(-1)" />
			</td>
		</tr>
	</table>  
	<input type="hidden" name="objectiveId" value="|-$objectiveId-|" />
	<input type="hidden" name="do" value="projectsDoWeightByObjective" />
</form>
<p>Se ha asignado el <span class="weightStatusDisplay">|-$totalWeight-|</span>% del peso total del objetivo. Para guardar los cambios debe asignar exactamente 100%<p>

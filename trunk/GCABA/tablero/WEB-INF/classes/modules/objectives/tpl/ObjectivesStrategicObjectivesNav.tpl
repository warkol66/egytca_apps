<script type="text/javascript" language="javascript" src="scripts/nav.js"></script>
|-if !empty($dependency)-|<h2>|-if $loginUser-|<a href="Main.php?do=tableroDependenciesNav">Dependencias</a> > |-/if-| |-$dependency->getName()-| </h2>
|-else-|<h2>|-if $loginUser-|<a href="Main.php?do=tableroDependenciesNav">Dependencias</a>|-/if-|</h2>
|-/if-|
<h1>Objetivos Estratégicos|-if $status ne ""-| - Status: |-$status-||-/if-|</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación se muestra la lista de Objetivos Estratégicos|-if !empty($dependency)-| de "<strong>|-$dependency->getName()-|</strong>"|-/if-|. Para ver los objetivos asociados al Objetivo Estratégico, haga click en el nombre del mismo. Si el Objetivo Estratégico no tiene vínculo asociado, es porque no tiene ningún ojetivo asociado.</p>
<p>Puede ver los objetivos asociados a una dependencia haciendo click en el nombre de la misma. Si la Dependencia no tiene vínculo asociado, es porque no tiene ningún ojetivo asociado.
<div id="div_objectives">
	<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives"> 
		<thead> 
			<tr class="thFillTitle"> 
				<th>Objetivo Estratégico</th>
				<th>Dependencia</th>
			</tr> 
		</thead> 
		<tbody>  
			|-foreach from=$objectives item=objective name=for_objectives-|
			<tr>
				<td>|-if $objective->getObjectivesCount() gt 0-|
					<a href="Main.php?do=tableroObjectivesNav&strategicObjectiveId=|-$objective->getId()-|" title="Ver Objetivos asociados al Objetivo Estratégico">|-$objective->getname()-| </a> 
				|-else-|
					|-$objective->getname()-|
				|-/if-|
				</td>
				<td>|-if $objective->getObjectiveCountByDependency() gt 0-|
				<a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$objective->getAffiliateId()-|" title="Ver Objetivos de la Dependencia">|-$objective->getDependencyName()-| </a> 
				|-else-|
					|-$objective->getDependencyName()-|
				|-/if-|
				</td>
			</tr> 
			|-/foreach-|
			|-if $pager-|
			<tr> 
				<td colspan="2" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr> 
			|-/if-|
		</tbody> 
	</table> 
</div>

|-include file="TableroReportsShow.tpl"-| 
|-if isset($result)-|
<div > 
	<dl>
	|-foreach from=$result item=dependency name=for_results-|
	
		<dd>|-$dependency->getName()-| (|-$dependency->getTableroObjectives()|@count-| Objetivos)</dd> 
		<dl>
		|-if ($level eq "objectives")-|
		    <dd>Cantidad de Objetivos: |-$dependency->getTableroObjectives()|@count-|</dd>
		    <dd>
		    	<p> <img src="Main.php?do=tableroReportsPlotPie&delayed=|-$dependency->getCountObjectivesDelayed()-|&late=|-$dependency->getCountObjectivesLate()-|&onTime=|-$dependency->getCountObjectivesOnTime()-|"> 
		    	</p> 
		    </dd>
		|-else-|
			|-foreach from=$dependency->getTableroObjectives() item=objective name=for_objectives-|
      			<dd> Objetivo: |-$objective->getName()-| </dd> 
      			<dl> 
      			|-if ($level eq "projects")-|
					<dd>Cantidad de Proyectos: |-$objective->getProjects()|@count-|</dd> 
      				|-foreach from=$dependency->getTableroObjectives() item=objective name=for_objectives-|
      				<dd> 
        				<p> Objetivo : |-$objective->getName()-| </p> 
        				<p> <img src="Main.php?do=tableroReportsPlotPie&delayed=|-$objective->getCountProjectsDelayed()-|&onTime=|-$objective->getCountProjectsOnTime()-|&late=|-$objective->getCountProjectsLate()-|"> </p> 
      				</dd> 
      				|-/foreach-|
      			|-else-|
	      			|-foreach from=$objective->getProjects() item=project name=for_projects-|
		      			<dd> Proyecto: |-$project->getName()-| </dd> 
		      			<dl> 
		      			|-if ($level eq "milestones" or $level eq "indicatorsAndMilestones")-|
							<dd>
		        				<p> 
		        					<img src="Main.php?do=tableroReportsPlotPie&delayed=|-$project->getCountMilestonesDelayed()-|&onTime=|-$project->getCountMilestonesOnTime()-|&late=|-$project->getCountMilestonesLate()-|"> 
		        				</p> 

							</dd>		      				
		      			|-/if-|
		      			</dl>
		      		|-/foreach-|
      			|-/if-|      			
      			</dl>		
			|-/foreach-|
		|-/if-|
    	</dl> 
    |-/foreach-|
  </dl> 
</div>
|-/if-| 

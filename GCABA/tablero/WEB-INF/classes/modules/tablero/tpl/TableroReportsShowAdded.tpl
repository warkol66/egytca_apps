|-include file="TableroReportsShow.tpl"-|
|-if isset($result)-|
	<div>
		<dl>
			|-foreach from=$result item=dependency name=for_results-|
				<p><dd>|-$dependency->getName()-| (|-$dependency->getTableroObjectives()|@count-| Objetivos)</dd></p>
				<dl>|-if ($level eq "objectives")-|
					<dd>Cantidad de Objetivos: |-$dependency->getTableroObjectives()|@count-|</dd>
						|-else-|
				|-foreach from=$dependency->getTableroObjectives() item=objective name=for_objectives-|
					<dd>|-$objective->getName()-| (|-$objective->getTableroProjects()|@count-| Proyectos : |-$objective->getNumberOfWorkingProjects()-| En Ejecucion - |-$objective->getNumberOfDelayedProjects()-| Retrasados - |-$objective->getNumberOfEndedProjects()-| Finalizados)</dd>				
					|-if ($level eq "projects")-|
						<dl>
							<dd>Cantidad de Proyectos: |-$objective->getTableroProjects()|@count-|</dd>				</dl>
					|-else-|
					<dl>
					|-foreach from=$objective->getProjects() item=project name=for_projects-|
					<dd>|-$project->getName()-| - Estado : |-if $project->isOnWork()-|En Ejecucion|-/if-| |-if $project->isDelayed()-|Retrasado|-/if-| |-if $project->isEnded()-|Finalizado|-/if-|</dd>
								|-if $level neq "projects"-|
							<dl>
								|-if $level eq "milestones" or $level eq "indicatorsAndMilestones"-|
									<dd>Cantidad de Milestones: |-$project->getMilestones()|@count-|</dd>
								|-/if-|
							</dl>
							<dl>
								|-if $level eq "indicators" or $level eq "indicatorsAndMilestones"-|
									<dd>Cantidad de Indicadores: |-$project->getIndicators()|@count-|</dd>
								|-/if-|
							</dl>
							|-/if-|	
					|-/foreach-|
					</dl>
					|-/if-|							
				|-/foreach-|
			|-/if-|					    
				</dl>
			|-/foreach-|
		</dl>
	</div>
|-/if-|					


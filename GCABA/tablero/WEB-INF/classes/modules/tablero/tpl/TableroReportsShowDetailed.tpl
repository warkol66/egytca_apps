|-include file="TableroReportsShow.tpl"-|

	|-if isset($result)-|
		<div >
			<dl>
				|-foreach from=$result item=dependency name=for_results-|
					<p>
					<dd>|-$dependency->getName()-| (|-$dependency->getTableroObjectives()|@count-| Objetivos)</dd>
					</p>

					<dl>
						|-foreach from=$dependency->getTableroObjectives() item=objective name=for_objectives-|				
						<dd>|-$objective->getName()-| (|-$objective->getProjects()|@count-| Proyectos : |-$objective->getNumberOfWorkingProjects()-| En Ejecucion - |-$objective->getNumberOfDelayedProjects()-| Retrasados - |-$objective->getNumberOfEndedProjects()-| Finalizados)</dd>
						|-if ($level neq "objectives")-|							
						<dl>						
						|-foreach from=$objective->getProjects() item=project name=for_projects-|
											
							<dd>|-$project->getName()-| - Estado : |-if $project->isOnWork()-|En Ejecucion|-/if-| |-if $project->isDelayed()-|Retrasado|-/if-| |-if $project->isEnded()-|Finalizado|-/if-|</dd>
									|-if $level neq "projects"-|
								<dl>
									|-if $level eq "milestones" or $level eq "indicatorsAndMilestones"-|
									|-foreach from=$project->getMilestones() item=milestone name=for_milestone-|
										<dd>|-$milestone->getName()-|</dd>
									|-/foreach-|
									|-/if-|
								</dl>


								<dl>
									|-if $level eq "indicators" or $level eq "indicatorsAndMilestones"-|
									|-foreach from=$project->getIndicators() item=indicator name=for_indicator-|
										<dd>|-$indicator->getName()-|</dd>
									|-/foreach-|
									|-/if-|
								</dl>

								|-/if-|	
						</dl>		
						|-/foreach-|


						|-/if-|							
						
					    |-/foreach-|    
					</dl>

					
				|-/foreach-|
			</dl>
		</div>
	|-/if-|					


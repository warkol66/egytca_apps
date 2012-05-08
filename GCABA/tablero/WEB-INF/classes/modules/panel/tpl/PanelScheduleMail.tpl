<p>|-$user->getName()-| |-$user->getSurname()-|,</p>
<h1>
	Su agenda para el próximo mes incluye:
</h1>
|-if $positions ne '' && !$positions->isEmpty() -|
<h2>
	Cargos
</h2>
<ul>
	|-foreach from=$positions item=position-|
	<li>
		<p style="text-decoration: underline;" >|-$position->getName()-|</p>
		
		|-assign var=startingProyects value=$position->getAllProjectsWithDescendants($projectPeer->getScheduleCriteriaForPlannedStart())-|
		|-include file="PanelScheduleMailInclude.tpl" entities=$startingProyects title="Proyectos que comienzan el proximo mes:"-|
		
		|-assign var=endingProjects value=$position->getAllProjectsWithDescendants($projectPeer->getScheduleCriteriaForPlannedEnd())-|
		|-include file="PanelScheduleMailInclude.tpl" entities=$endingProjects title="Proyectos que finalizan el proximo mes:"-|
		
		|-assign var=startingObjectives value=$position->getAllObjectivesWithDescendants($objectivePeer->getScheduleCriteriaForPlannedStart())-|
		|-include file="PanelScheduleMailInclude.tpl" entities=$startingObjectives title="Objetivos que comienzan el proximo mes:"-|
		
		|-assign var=endingObjectives value=$position->getAllObjectivesWithDescendants($objectivePeer->getScheduleCriteriaForPlannedEnd())-|
		|-include file="PanelScheduleMailInclude.tpl" entities=$endingObjectives title="Objetivos que finalizan el proximo mes:"-|
	</li>
	|-/foreach-|
</ul>
|-/if-|

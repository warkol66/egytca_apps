<p>|-$user->getName()-| |-$user->getSurname()-|,</p>
<h1>
	Recordatorio de los próximos vencimientos
</h1>
|-if $positions ne '' && !$positions->isEmpty() -|
<h2>
	Cargos
</h2>
<ul>
	|-foreach from=$positions item=position-|
	<li>
		<p style="text-decoration: underline;" >|-$position->getName()-|</p>
		
		|-assign var=endingProjects value=$position->getAllProjectsWithDescendants($projectPeer->getAlertCriteriaForPlannedEnd())-|
		|-include file="PanelScheduleMailInclude.tpl" entities=$endingProjects title="Proyectos que finalizan proximamente:"-|
		
		|-assign var=endingObjectives value=$position->getAllObjectivesWithDescendants($objectivePeer->getAlertCriteriaForPlannedEnd())-|
		|-include file="PanelScheduleMailInclude.tpl" entities=$endingObjectives title="Objetivos que finalizan proximamente:"-|
	</li>
	|-/foreach-|
</ul>
|-/if-|

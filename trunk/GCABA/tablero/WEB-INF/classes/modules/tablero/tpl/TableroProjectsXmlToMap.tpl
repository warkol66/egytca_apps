<xml version="1.0" encoding="UTF-8">
<parks>
|-foreach from=$projects item=project name=for_projects-|	<park>
		<point lat="|-$project->getLatitude()|number_format:8-|" lng="|-$project->getLongitude()|number_format:8-|" id="|-$project->getid()-|" info="|-$project->getname()|escape|trim-|" Localidad="|-if $project->getRegion() eq "Sin especificar"-||-else-||-$project->getRegion()|escape-||-/if-|" Dependency="|-$project->getDependency()|escape-|"/>
		<icon image="images/|-$project->getImageIcon()-|"/>
	</park>
|-/foreach-|						
	</parks>
</xml>

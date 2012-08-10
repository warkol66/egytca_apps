<style type="text/css">
<!--
.ImpactObjective { background-color: #00CC33;border: 1px solid blue; padding: 15px; }
.MinistryObjective { background-color: #FFFF66;border: 1px solid blue; padding: 15px; }
.OperativeObjective { background-color: #0099FF;border: 1px solid blue; padding: 15px; }
.PlanningProject { background-color: #FF9900;border: 1px solid blue; padding: 15px; }
.PlanningConstruction { background-color: #66CCFF;border: 1px solid blue; padding: 15px; }
.PlanningActivity { background-color: #66CCFF;border: 1px solid blue; padding: 15px; }

.ImpactObjective, .MinistryObjective, .OperativeObjective, .PlanningProject,
.PlanningConstruction, .PlanningActivity, #treeRoot {
	-khtml-border-radius: .5em !Important;
	-opera-border-radius: .5em !Important;
	-moz-border-radius: .5em !Important;
	-webkit-border-radius: .5em !Important;
	border-radius: .5em !Important;
}

-->
</style>
<h2>Objetivos y proyectos 2013</h2>
<h1>Planificación 2013 - |-$root-|</h1>
<div id="treeRoot" style="border: 1px solid blue; background-color:#BDFDE6; padding: 15px;">
	|-if method_exists($root, 'getBrood') && $root->getBrood()|count gt 0-|
		|-include file="PlanningTreeDivsInclude.tpl" isTreeRoot=true-|
	|-/if-|
</div>
<style type="text/css">
<!--
#treeRoot { background-color: #CCCCCC;border: 1px solid #CDCDCD; padding: 15px 4px 4px 4px; }
.ImpactObjective { background-color: #00CC33;border: 1px solid #CDCDCD; padding: 15px 4px 4px 4px;  }
.MinistryObjective { background-color: #FFFF66;border: 1px solid #CDCDCD; padding: 15px 4px 4px 4px;  }
.OperativeObjective { background-color: #0099FF;border: 1px solid #CDCDCD; padding: 15px 4px 4px 4px;  }
.PlanningProject { background-color: #FF9900;border: 1px solid #CDCDCD; padding: 15px 4px 4px 4px;  }
.PlanningConstruction { background-color: #66CCFF;border: 1px solid #CDCDCD; padding: 15px 4px 4px 4px;  }
.PlanningActivity { background-color: #66CCFF;border: 1px solid #CDCDCD; padding: 15px 4px 4px 4px;  }
.ImpactObjective, .MinistryObjective, .OperativeObjective, .PlanningProject,
.PlanningConstruction, .PlanningActivity, #treeRoot {
	-khtml-border-radius: 1em !Important;
	-opera-border-radius: 1em !Important;
	-moz-border-radius: 1em !Important;
	-webkit-border-radius: 1em !Important;
	border-radius: 1em !Important;
	-moz-box-shadow:0 2px 4px #808080;
	-webkit-box-shadow:0 2px 4px #a0a0a0;
	box-shadow:0 2px 4px #808080;
}
#treeRoot a, #treeRoot a:link, #treeRoot a:visited {
	text-decoration: none !Important;
	margin-left: .5em !Important;
/*	background-image: url(../images/icon_follow.png) !Important; */
	background-repeat: no-repeat;
	color: black !Important;
}
#treeRoot a.followLink:hover, #treeRoot a:hover {
	text-decoration: underline !Important;
}
#treeRoot h4 {
	margin-top: 0 !Important;
	padding-top: 0 !Important;
	margin-left: .5em !Important;
	margin-bottom: .5em !Important;
}
#treeRoot p {
	margin-top: 1em !Important;
	margin-bottom: 1em !Important;
	margin-left: 1.5em !Important;
}
#MinistryObjective h4 {
	color: #333333!Important;
}
-->
</style>
<h2>Objetivos y proyectos 2013</h2>
<h1>Planificación 2013 - |-$root-|</h1>
<div id="treeRoot">
	|-if method_exists($root, 'getBrood') && $root->getBrood()|count gt 0-|
		|-include file="PlanningTreeDivsInclude.tpl" isTreeRoot=true-|
	|-/if-|
</div>
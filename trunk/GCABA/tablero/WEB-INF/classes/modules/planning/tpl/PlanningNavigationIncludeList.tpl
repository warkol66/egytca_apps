	|-if !is_null($object) && is_object($object)-|
	|-assign var=parent value=$object->getAntecessor()-|
	|-assign var=brood value=$object->getBrood()-|
	|-assign var=primero value=$brood[0]-|	
	|-assign var=clase get_class($primero)-|
	|-include file="PlanningNavigationIncludeList.tpl" object=$parent-|	
	|-if get_class($object) eq "Position"-| <a href="Main.php?do=planningImpactObjectivesList&id=|-$object->getId()-|&nav=true&objectives=true&filters[entityFilter][entityType]=position&filters[entityFilter][entityId]=|-$object->getId()-|">|-$object-| </a>
	|-else-| <img src="images/path_Mark.png" width="9" height="10" />
	<a href="Main.php?do=planning|-str_replace("Planning","",get_class($primero))-|sList&nav=true&filters[|-strtolower(get_class($object))-|id]=|-$object->getId()-|">|-$object->getStringCode()-|&nbsp;|-$object-| </a> |-/if-| 
	|-/if-|
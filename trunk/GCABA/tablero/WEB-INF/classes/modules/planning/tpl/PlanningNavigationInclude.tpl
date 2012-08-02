	|-if !is_null($object) && is_object($object)-|
	|-assign var=parent value=$object->getAntecessor()-|
			|-include file="PlanningNavigationInclude.tpl" object=$parent-|
	|-if get_class($object) eq "Position"-| |-$object-| |-else-| <img src="images/path_Mark.png" width="9" height="10" /> |-if $show || $readOnly-| |-$object-| |-else-|  <a href="Main.php?do=planning|-get_class($object)-|sEdit&id=|-$object->getId()-|"> |-$object-| </a> |-/if-|  |-/if-| 
	|-/if-|

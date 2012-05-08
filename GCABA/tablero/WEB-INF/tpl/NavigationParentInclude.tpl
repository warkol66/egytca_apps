	|-if !empty($first)-|<a href="Main.php?do=objectivesPolicyGuidelinesList">##objectives,4,Ejes de Gestión##</a> 	<img src="images/path_Mark.png"  width="9" height="10" /> |-/if-|
	|-assign var=parentPath value=$object->getParentLinkPath()-|
	|-if !is_null($parentPath)-|
	|-if is_object($parentPath.parentObject)-||-include file="NavigationParentInclude.tpl" object=$parentPath.parentObject first=""-||-/if-| 
	<a href="Main.php?do=|-$parentPath.parentLink-||-$parentPath.parentId-|">|-if is_object($parentPath.parentObject)-||-$parentPath.parentObject->getName()-||-/if-|</a> 	<img src="images/path_Mark.png" width="9" height="10" />
	|-/if-|

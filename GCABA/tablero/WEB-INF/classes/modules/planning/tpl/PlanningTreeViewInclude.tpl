|-if $isTreeRoot-|
	|-assign var=nodeId value=1-|
	|-assign var=isTreeRoot value=false-|
	myTree.add( 1, -1, '<span class="data">|-$root|escape:javascript-|</span><li>|-$root->getId()|escape:javascript-|</li>');
		|-if method_exists($root, 'getBrood') && $root->getBrood()|count gt 0-|
			|-assign var=descendants value=$root->getBrood()-|
			|-foreach $descendants as $descendant-|
				|-include file="PlanningTreeViewInclude.tpl" root=$descendant parentId=1 nodeId=$nodeId-|
			|-/foreach-|
		|-/if-|
|-else-||-assign var=nodeId value=$nodeId+1-|
	myTree.add(|-$nodeId-|,|-$parentId-|,'<span class="data">|-$root|escape:javascript-|</span><li>|-$root->getId()|escape:javascript-|</li>');
	|-if method_exists($root, 'getBrood') && $root->getBrood()|count gt 0-|
		|-assign var=descendants value=$root->getBrood()-|
		|-foreach $descendants as $descendant-|
		|-if $descendant@first-||-assign var=parentId value=$nodeId-||-/if-|
			|-include file="PlanningTreeViewInclude.tpl" root=$descendant parentId=$parentId nodeId=$nodeId-|
		|-/foreach-|
	|-/if-|
|-/if-|

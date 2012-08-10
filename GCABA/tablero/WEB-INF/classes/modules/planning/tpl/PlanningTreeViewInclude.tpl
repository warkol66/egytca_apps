|-if $isTreeRoot-||-assign var=nodeId value=1-||-assign var=isTreeRoot value=false-|
	myTree.add(|-counter start=1-|,-1,'<span class="data">|-$root|escape:javascript-|</span><li>|-$root->getId()|escape:javascript-|</li>');
		|-if method_exists($root, 'getBrood') && $root->getBrood()|count gt 0-||-assign var=descendants value=$root->getBrood()-|
			|-foreach $descendants as $descendant-|
				|-include file="PlanningTreeViewInclude.tpl" root=$descendant parentId=1-|
			|-/foreach-|
		|-/if-|
|-else-|myTree.add(|-counter assign=parentNew-||-$parentNew-|,|-$parentId-|,'<span class="data">|-$root|escape:javascript-|</span><li>|-$root->getId()|escape:javascript-|</li>');
	|-if method_exists($root, 'getBrood') && $root->getBrood()|count gt 0-||-assign var=descendants value=$root->getBrood()-|
		|-foreach $descendants as $descendant-||-if $descendant@first-||-assign var=parentId value=$nodeId-||-/if-|
			|-include file="PlanningTreeViewInclude.tpl" root=$descendant parentId=$parentNew-|
		|-/foreach-|
	|-/if-|
|-/if-|

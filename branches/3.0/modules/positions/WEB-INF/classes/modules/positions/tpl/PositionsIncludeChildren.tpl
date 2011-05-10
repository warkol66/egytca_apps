|-foreach from=$node->getChildren() item=node-|
	<li>
	|-$node->getName()-|
		<ul>
		|-include file="PositionsIncludeChildren.tpl" node=$node-|
		</ul>
	</li>
|-/foreach-|
|-assign var=parent value=$issue->getParentIssue()-|
|-if $parent neq ''-|
<label for='p_parent'>Padre</label>
<p id='p_parent'>
	<a href='Main.php?do=issuesShowRelated&id=|-$parent->getId()-|'>|-$parent->getName()-|</a>
</p>
|-/if-|

|-assign var=childs value=$issue->getChildIssues()-|
|-if $childs neq ''-|
<label for='ul_childs'>Hijos</label>
<ul id='ul_childs'>
	|-foreach from=$childs item=child-|
	<li><a href='Main.php?do=issuesShowRelated&id=|-$child->getId()-|'>|-$child->getName()-|</a></li>
	|-/foreach-|
</ul>
|-/if-|
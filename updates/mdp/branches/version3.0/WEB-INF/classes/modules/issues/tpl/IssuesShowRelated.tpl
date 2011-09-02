<label for='p_issue'>Asunto</label>
<p id='p_issue'>
	|-$issue->getName()-|
</p>

|-if $parent neq ''-|
<label for='p_parent'>Padre</label>
<p id='p_parent'>
	<a href='Main.php?do=issuesShowRelated&id=|-$parent->getId()-|'>|-$parent->getName()-|</a>
</p>
|-/if-|

|-if $childsCount neq 0-|
<label for='ul_childs'>Hijos</label>
<ul id='ul_childs'>
	|-foreach from=$childs item=child-|
	<li><a href='Main.php?do=issuesShowRelated&id=|-$child->getId()-|'>|-$child->getName()-|</a></li>
	|-/foreach-|
</ul>
|-/if-|
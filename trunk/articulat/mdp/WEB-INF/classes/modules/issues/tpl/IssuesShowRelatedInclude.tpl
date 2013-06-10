|-if $issue->getParentIssue() != '' || $issue->getChildIssues() != ''-|
<fieldset>
<legend>##issues,1,Asuntos## relacionados</legend>
|-assign var=parent value=$issue->getParentIssue()-|
|-if $parent neq ''-|
<h5>##issues,19,Sub asunto de##</h5>
<p id='p_parent'>
	<a href='Main.php?do=issuesEdit&id=|-$parent->getId()-|&submit_go_edit_issue=Editar' class="blackNoDecoration" title="ir al asunto">|-$parent->getName()-| <img src="images/clear.png" class="icon iconGoTo"> </a>
</p>
|-/if-|
|-assign var=childs value=$issue->getChildIssues()-|
|-if $childs neq ''-|
<h5>##issues,20,Sub asuntos##</h5>
<ul id='ul_childs' class="iconOptionsList">
	|-foreach from=$childs item=child-|
	<li><a href='Main.php?do=issuesEdit&id=|-$child->getId()-|&submit_go_edit_issue=Editar' class="blackNoDecoration" title="ir al asunto">|-$child->getName()-| <img src="images/clear.png" class="icon iconGoTo"> </a></li>
	|-/foreach-|
</ul>
|-/if-|</fieldset>
|-/if-|
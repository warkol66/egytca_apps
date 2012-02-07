|-if $section->getParentSectionId()-|
	<div style="display:inline"><a href="javascript:void(null)" onclick="document.getElementById('form_section_|-$section->getId()-|').style.display = 'inline'" title="##114,Editar##"><img src="images/clear.png" class="icon iconEdit" /></a>
		<form method='POST' action="Main.php?do=profilesFormQuestionDoEdit&delete=1&sectionId=|-$section->getId()-|&form=|-$form->getId()-|#edit" name='formsection|-$section->getId()-|' style="display:inline">
			<a href="javascript:document.formsection|-$section->getId()-|.submit();" title="##115,Eliminar##" onclick="return confirm('##214,¿Está seguro que desea eliminar esta sección y todas las preguntas asociadas?##')"><img src="images/clear.png" class="icon iconDelete" /></a>
		</form> 
	</div> (S)	|-$section->getTitle()-| |-include file="ProfilesSectionEditInclude.tpl" section=$section do=profilesFormDoEdit-|
|-/if-|
<ul>|-foreach from=$section->getQuestionsOrdered() item=question-|
	<li>
		<div style="display:inline"><a href="Main.php?do=profilesFormQuestionEdit&edit=1&questionId=|-$question->getId()-|&form=|-$form->getId()-|#edit" title="##114,Editar##"><img src="images/clear.png" class="icon iconEdit" /></a>
			<form  method='POST' action="Main.php?do=profilesFormQuestionDoEdit&delete=1&questionId=|-$question->getId()-|&form=|-$form->getId()-|#edit"  name='formquestion|-$question->getId()-|' style="display:inline">
				<a href="javascript:document.formquestion|-$question->getId()-|.submit();" title="##115,Eliminar##" onclick="return confirm('##215,¿Está seguro que desea eliminar esta pregunta?##')"><img src="images/clear.png" class="icon iconDelete" /></a>
			</form> 
		</div> |-$question->getQuestion()-|
	</li> 
	|-/foreach-||-foreach from=$section->getChildSections() item=childSection-|
	<li>|-include file="ProfilesFormSectionEditInclude.tpl" section=$childSection-|</li> 
	|-/foreach-|
</ul>
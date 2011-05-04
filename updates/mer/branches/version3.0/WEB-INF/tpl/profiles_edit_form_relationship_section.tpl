|-if $section->getParentSectionId() -|
			(S)&nbsp;|-$section->getTitle()-|
			|-include file="profiles_include_edit_section.tpl" section=$section do=doProfilesFormRelEdit-|
			<div class='questionActions' style="display:inline">
      	[&nbsp;<a href="#" onclick="document.getElementById('form_section_|-$section->getId()-|').style.display = 'inline'" class='deta'>##114,Editar##</a>&nbsp;]
	<form method='POST' action="Main.php?do=doProfilesFormRelEdit&delete=1&sectionId=|-$section->getId()-|&form=|-$form->getId()-|#edit" name='formsection|-$section->getId()-|' style="display:inline">
					[&nbsp;<a href="javascript:document.formsection|-$section->getId()-|.submit();" class='elim' onclick="return confirm('##214,¿Está seguro que desea eliminar esta sección y todas las preguntas asociadas?##')">##115,Eliminar##</a>&nbsp;]
				</form>
</div>
|-/if-|
<ul>
	|-foreach from=$section->getQuestionsOrder() item=question-|
	<li> |-$question->getQuestion()-|
		<div class='questionActions' style="display:inline"> [&nbsp;<a href="Main.php?do=profilesFormRelEdit&edit=1&questionId=|-$question->getId()-|&form=|-$form->getId()-|#edit" class='deta'>##114,Editar##</a>&nbsp;]
			<form method='POST' action="Main.php?do=doProfilesFormRelEdit&delete=1&questionId=|-$question->getId()-|&form=|-$form->getId()-|#edit" name='formquestion|-$question->getId()-|' style="display:inline">
				[&nbsp;<a href="javascript:document.formquestion|-$question->getId()-|.submit();" class='elim' onclick="return confirm('##215,¿Está seguro que desea eliminar esta pregunta?##')">##115,Eliminar##</a>&nbsp;]
			</form>
		</div>
	</li>
	|-/foreach-|
	|-foreach from=$section->getChildSections() item=childSection-|
	<li> |-include file=profiles_edit_form_relationship_section.tpl section=$childSection -| </li>
	|-/foreach-|
</ul>

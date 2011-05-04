<optgroup label="|-$section->getTitle()-|">

	|-foreach from=$section->getQuestionsOrder() item=question-|
	<option value="|-$question->getId()-|"|-if in_array($question->getId(),$questions)-| selected="selected"|-/if-|>
		|-$question->getQuestion()-|
	</option>
	|-/foreach-|
	|-foreach from=$section->getChildSections() item=childSection-|
		|-include file=analysis_include_form_section_options.tpl section=$childSection questions=$questions-|
	|-/foreach-|

</optgroup>


<table class="tableTdBorders" border="0" cellpadding="0" cellspacing="1" width="100%">
|-if $smarty.request.showAll or $section->doCountQuestionsForActor($actor) gt 0-|
	<tr>
		<td valign='top' colspan='|-if $smarty.request.showAll-|3|-else-|2|-/if-|'>|-$section->getTitle()-|</td>
	</tr>
|-/if-|
|-if $smarty.request.showAll-|
	|-assign var=questions value=$section->getQuestionsOrdered($actor)-|
|-else-|
	|-assign var=questions value=$section->getQuestionsForActor($actor)-|
|-/if-|
|-foreach from=$questions item=question-|
	<tr>	
		<td width='55%' valign='top'><label for='q_|-$question->getId()-|'>|-$question->getQuestion()-|</label></td>
	|-if $smarty.request.showAll-|
		<td width='5%'>
			<input type="checkbox" id="active_|-$question->getId()-|" name="applyableQuestions[]" value="|-$question->getID()-|" |-$question->appliesTo($actor)|checked_bool-| />
		</td>
	|-/if-|
		<td width='40%' nowrap='nowrap'>|-$question->toHTML($actor)-|</td>
	</tr>
|-/foreach-|
|-foreach from=$section->getChildSections() item=childSection-|
	<tr>
		<td style='padding-left:12px;' colspan='|-if $smarty.request.showAll-|3|-else-|2|-/if-|' width="100%">
			|-include file="ProfilesEditSectionInclude.tpl" section=$childSection-|
		</td>
	</tr>
|-/foreach-|
</table>
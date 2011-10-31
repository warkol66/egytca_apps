<table class="tableTdBorders" border="0" cellpadding="0" cellspacing="1" width="100%">
	|-if $section->doCountQuestionsForActor($actor) gt 0-|
	<tr>
	<td valign='top' colspan='2' class='celltitulo'><div class="titulo2">|-$section->getTitle() -|</div></td>
	</tr>
	|-/if-|
	|-assign var=questions value=$section->getQuestionsForActor($actor)-|
	|-foreach from=$questions item=question-|
	<tr>
		<td width='70%' valign='top' class='celltitulo'><div class='titulo2'>|-$question->getQuestion()-|</div></td>
		<td width="30%">|-$question->getAnswer($actor)-|</td>
	</tr>
|-/foreach-|
|-foreach from=$section->getChildSections() item=childSection-|
	<tr>
		<td colspan='2' class='cellwhite' style='padding-left:12px;'><div id='|-$childSection->getId()-|' style='display:block;'>
			|-include file=profiles_form_view_section.tpl section=$childSection -|</div>
			<div id='hide|-$childSection->getId()-|' class='texto_noimprimir'>
					<input type='submit' id='button|-$childSection->getId()-|' value='Ocultar Sección' class='hidebutton' onClick='switch_vis("|-$childSection->getId()-|");switch_value("button|-$childSection->getId()-|");' />
					</div>
		</td>
	</tr>
|-/foreach-| 
</table>
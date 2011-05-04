|-if $section->doCountQuestionsForRelationship($actor1,$actor2) gt 0 || $section->getChildSections() ne ""-|
<tr>
	<td colspan="3" class='celltitulo'><div class="titulo2">|-$section->getTitle() -|</div></td>
</tr>
<tr>
	<td colspan="3" class="cellwhite" style='padding-left:12px;'>
		<table cellpadding="0" cellspacing="1" class="tablaborde" width="100%">
			<tr>
				<th width="50%">##207,Indicador##</th>
				<th width="25%">##208,Actual##</th>
				<th width="25%">##209,Potencial##</th>
			</tr>
			|-foreach from=$section->getQuestionsForRelationship($actor1,$actor2) item=question-|
			|-assign var=values value=$question->getRelationshipValues($actor1,$actor2)-|
			<tr>
				<td valign='top' class='celltitulo'><div class='titulo2'><label for='q_|-$question->getId()-|'>|-$question->getQuestion()-|</label></div></td>
				<td class='celldato'>|-$values[0]-| |-$question->getUnit()-|</td>
				<td class='celldato'>|-$values[1]-| |-$question->getUnit()-|</td>
			</tr>
			|-/foreach-|
			|-foreach from=$section->getChildSections() item=childSection-|
			<tr>
				<td colspan="3" class="cellwhite"><div id='|-$childSection->getId()-|' style='display:block;'>|-include file=profiles_view_form_relationship_section.tpl section=$childSection -|<div id='hide|-$childSection->getId()-|' class='texto_noimprimir' style="display:none;">
					<input type='submit' id='button|-$childSection->getId()-|' value='Ocultar Sección' class='hidebutton' onClick='switch_vis("|-$childSection->getId()-|");switch_value("button|-$childSection->getId()-|");' />
					</div></td>
			</tr>
			|-/foreach-|
		</table></td>
</tr>
|-/if-|

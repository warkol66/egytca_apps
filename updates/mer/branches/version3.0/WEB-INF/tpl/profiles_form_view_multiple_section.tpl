<table class="tablaborde" border="0" cellpadding="0" cellspacing="1" width="100%">
 	|-foreach from=$section->doSelectQuestions() item=question name=foreachQuestions-||-if $smarty.foreach.foreachQuestions.first-|
	<tr>
		<td class='celltitulo' width='20%'><div class="titulo2">|-$childSection->getTitle()-|</div></td> 
		|-foreach from=$actors item=actor-|
		<td class='celltitulo' width='|-$cellwidth-|%'><div class="titulo2">|-$actor->getName()-|</div></td> 
		|-/foreach-|</tr> 
	|-/if-|
	<tr> 
		<td width='20%' valign='top' class='celltitulo'><div class='titulo2'>|-$question-|</div></td> 
		|-foreach from=$actors item=actor-|
		<td class='celldato' width='|-$cellwidth-|%'>|-$question->getAnswer($actor)-|</td> 
		|-/foreach-|</tr> 
	|-/foreach-||-foreach from=$section->getChildSections() item=childSection-|
	<tr> 
		<td colspan='|-$colspan-|' class='cellwhite' style='padding-left:12px;'><div id='|-$childSection->getId()-|' style='display:block;'> |-include file=profiles_form_view_multiple_section.tpl section=$childSection-|</div> 
			<div id='hide|-$childSection->getId()-|' class='texto_noimprimir'><input type='submit' id='button|-$childSection->getId()-|' value='Ocultar Sección' class='hidebutton' onClick='switch_vis("|-$childSection->getId()-|");switch_value("button|-$childSection->getId()-|");' /></div>
		</td> 
	</tr>|-/foreach-|
</table>
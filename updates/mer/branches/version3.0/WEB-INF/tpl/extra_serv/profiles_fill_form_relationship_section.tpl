|-if $smarty.request.showAll ne '' || $section->doCountQuestionsForRelationship($actor1,$actor2) > 0 || $section->getChildSections() ne ""-|
<!--
<script type="text/javascript">
	function setActiveQuestion(id){
		var input = document.getElementById("q_"+id);		
		var event = input.addEventListener("change",function(e){alert(document.getElementById('active_'+id));});		
	}
</script>
-->
|-if $smarty.request.showAll-|
		|-assign var=questions value=$section->getQuestionsOrder($actor1)-|
	|-else-|
		|-assign var=questions value=$section->getQuestionsForRelationship($actor1,$actor2)-|
	|-/if-|
	|-foreach from=$questions item=question-|
		<tr>
	<td width='60%' valign='top' class='celltitulo'><div class='titulo2'>
			<label for='q_|-$question->getId()-|'>|-$question->getQuestion()-|</label>
		</div></td>
	<td width="4%" class="celldato">|-if $smarty.request.showAll-|
				<input type="checkbox" id="active_|-$question->getId()-|" name="applyableQuestions[]" value="|-$question->getID()-|" |-if $question->appliesToRelationship($actor1,$actor2) -|checked='checked'|-/if-| />|-/if-|</td>
	<td width="26%" nowrap="nowrap">|-$question->relationshipToHTML($actor1,$actor2)-|
				<!-- <script type="text/javascript">setActiveQuestion(|-$question->getId()-|)
				</script>
				--></td>
	<td width="10%" nowrap="nowrap">|-$question->getUnit()-|</td>
</tr>
|-/foreach-|
	|-foreach from=$section->getChildSections() item=childSection-|
	<tr>
	<td colspan="4" class="fondoffffff">
	<tr>
	<td class="fondoffffff" colspan="4">
	  |-if $smarty.request.showAll or $childSection->doCountQuestionsForRelationship($actor1,$actor2) gt 0-|
		<strong>
			<div class='titulo2'>|-$section->getTitle() -|</div>
		</strong>
		|-/if-|
		|-include file=profiles_fill_form_relationship_section.tpl section=$childSection -| </td>
</tr>
|-/foreach-|
</td>
</tr>
|-/if-| 

|-if $message eq "error"-|<span class="message_error">Error al intentar asignar la etiqueta a la pregunta</span>|-/if-|

<h2>Questions Labels</h2>

<ul>
	|-foreach from=$analysisQuestions item=question name=for_analysis_questions-|
	<li>
		|-$question->getQuestion()-| -
		Label: |-$question->getLabel()-|
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="question" value="|-$question->getId()-|" />
						<input type="hidden" name="do" value="analysisQuestionLabelDoDelete" />
						<input type="submit" value="Delete" />
					</form>
	</li>
	|-/foreach-|
</ul>

					<form action="Main.php" method="post">
						<select name="question">
							<option value="">Select Question</option>
						|-foreach from=$forms item=form -|
							|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection()-|
						|-/foreach-|
						</select>
						<label for="question_label">Label</label>
						<input type="text" name="question_label" />
						<input type="hidden" name="do" value="analysisQuestionLabelDoEdit" />
						<input type="submit" value="Add" />
					</form>

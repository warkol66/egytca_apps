<h2>Questions</h2>

<ul>
	|-foreach from=$analysisQuestions item=question name=for_analysis_questions-|
	<li>
		|-$question->getQuestion()-|
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="question" value="|-$question->getId()-|" />
						<input type="hidden" name="do" value="analysisQuestionDoDelete" />
						<input type="submit" value="Delete" />
					</form>
	</li>
	|-/foreach-|
</ul>

					<form action="Main.php" method="post">
						<select name="question">
							<option value="">Select Question</option>
						|-foreach from=$forms item=form-|
							|-include file=analysis_include_form_section_options.tpl section=$form->getRootSection()-|
						|-/foreach-|
						</select>
						<input type="hidden" name="do" value="analysisQuestionDoEdit" />
						<input type="submit" value="Add" />
					</form>

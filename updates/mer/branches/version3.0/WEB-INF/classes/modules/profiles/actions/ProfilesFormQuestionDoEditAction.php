<?php

class ProfilesFormQuestionDoEditAction extends BaseAction {

	function ProfilesFormQuestionDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$module = "Mer";
		$section = "Profiles";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);			

		if ($request->getParameter("questionId")) {
			try {
				$question = QuestionQuery::create()->findPK($request->getParameter("questionId"));
			}
			catch (PropelException $e) {
				echo "Error retrieving question id:".$request->getParameter("questionId");
			}
		}
		elseif ($request->getParameter("edit"))
			$question = new Question();
		elseif ($request->getParameter("delete") && $request->getParameter("sectionId")) {
			// delete section
			$section = FormSectionQuery::create()->findPK($request->getParameter("sectionId"));
			if ($section)
				$section->delete();
		}
		if ($request->getParameter("edit_section") && $request->getParameter("sectionId")) {
			// edit section
			$section = FormSectionQuery::create()->findPK($request->getParameter("sectionId"));
			if ($section) {
				$section->setTitle($request->getParameter("newTitle"));
				$section->save();
			}
		}
		if ($request->getParameter("edit") && $question) { // save new question and create section if needed
			if ($request->getParameter("newSection") && $request->getParameter("newSectionParentId")) {
				$section = new FormSection();
				$section->setTitle($request->getParameter("newSection"));
				$section->setParentsectionid($request->getParameter("newSectionParentId"));
				$section->save();
				$question->setSectionid($section->getId());					
			}
			else			
				$question->setSectionid($request->getParameter("sectionId"));			

			$question->setType($request->getParameter("questionType"));
			$question->setUnit($request->getParameter("unit"));
			$question->setQuestion($request->getParameter("question"));
			$question->setPosition($request->getParameter("position"));
			try {
				$question->save();
			}
			catch (PropelException $e) {
				echo "Error saving Question";			
			}
			if ($request->getParameter("questionType") == QuestionPeer::TYPE_OPTIONS)
				$question->replaceOptions($request->getParameterValues("opc"),$request->getParameterValues("rta"),$request->getParameter("default"));

		}
		elseif ($request->getParameter("delete") && !empty($question) && is_object($question) && $question->getId())
			$question->delete();

		$actionForward = $request->getParameter("forward");
		if (empty($actionForward))
			$actionForward = "profilesFormQuestionEdit";

		header("Location: Main.php?do=".$actionForward."&id=".$request->getParameter("id"));
		exit;
	}
}

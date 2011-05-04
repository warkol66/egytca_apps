<?php

require_once("BaseAction.php");
require_once("mer/Question.php");

class DoProfilesFormEditAction extends BaseAction {



	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$module = "Mer";
		$section = "Profiles";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);			

		if ($request->getParameter("questionId")){
			try{
				$question = questionPeer::retrieveByPK($request->getParameter("questionId"));
			}catch (PropelException $e){
				echo "Error retrieving question id:".$request->getParameter("questionId");
			}
		}elseif($request->getParameter("edit")){
			$question = new question();
		}elseif($request->getParameter("delete") && $request->getParameter("sectionId")){
			// delete section
			require_once("mer/FormSection.php");
			$section = FormSectionPeer::retrieveByPk($request->getParameter("sectionId"));
			if ($section){
				$section->delete();
			}
		}
		if($request->getParameter("edit_section") && $request->getParameter("sectionId")){
			// edit section
			require_once("mer/FormSection.php");
			$section = FormSectionPeer::retrieveByPk($request->getParameter("sectionId"));
			if ($section){
				$section->setTitle($request->getParameter("newTitle"));
				$section->save();
			}
		}
		if ($request->getParameter("edit") && $question){ // save new question and create section if needed
			if ($request->getParameter("newSection") && $request->getParameter("newSectionParentId") ){
				require_once("mer/FormSection.php");
				$section = new formSection();
				$section->setTitle($request->getParameter("newSection"));
				$section->setParentsectionid($request->getParameter("newSectionParentId"));
				$section->save();
				$question->setSectionid($section->getId());							
			}else{			
				$question->setSectionid($request->getParameter("sectionId"));			
			}
			$question->setType($request->getParameter("questionType"));
			$question->setUnit($request->getParameter("unit"));
			$question->setQuestion($request->getPArameter("question"));
			$question->setPosition($request->getParameter("position"));
			try {
				$question->save();
			}catch (PropelException $e){
				echo "Error saving Question";			
			}
			if ($request->getParameter("questionType") == QUESTION_TYPE_OPTIONS){
				$question->replaceOptions($request->getParameterValues("opc"),$request->getParameterValues("rta"),$request->getParameter("default"));
			}
		}elseif ($request->getParameter("delete") && !empty($question) && is_object($question) && $question->getId()){
			$question->delete();
		}
		$actionForward = $request->getParameter("forward");
		if (empty($actionForward))
					$actionForward = "profilesFormEdit";
		header("Location: Main.php?do=".$actionForward."&form=".$request->getParameter("form"));
		exit;
	}
}
?>

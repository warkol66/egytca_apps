<?php

require_once("BaseAction.php");

class ObjectivesStrategicObjectivesDoAddDocumentToObjectiveXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ObjectivesStrategicObjectivesDoAddDocumentToObjectiveXAction() {
		;
	}


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

		//por ser una action ajax.
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Objectives";

		if ( !empty($_POST["objectiveId"]) && !(empty($_POST["documentId"])) ) {

			$objective = StrategicObjectivePeer::get($_POST["objectiveId"]);
			$document = DocumentPeer::get($_POST["documentId"]);

			$smarty->assign('document',$document);
			$smarty->assign('objective',$objective);

			if (!empty($objective) && !empty($document)) {

				$relation = new DocumentObjective();
				$result = $relation->create($_POST["objectiveId"],$_POST["documentId"]);

				if ($result)
					return $mapping->findForwardConfig('success');
				else {
					$smarty->assign('errorTagId','documentMsgField');
					return $mapping->findForwardConfig('failure');
				}

			}

		}

		$smarty->assign('errorTagId','documentMsgField');
		return $mapping->findForwardConfig('failure');
	}

}

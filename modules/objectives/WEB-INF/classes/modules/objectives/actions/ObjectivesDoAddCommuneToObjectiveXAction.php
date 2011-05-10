<?php

require_once("BaseAction.php");

class ObjectivesDoAddCommuneToObjectiveXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ObjectivesDoAddCommuneToObjectiveXAction() {
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
		//TODO VERIFICACION USUARIOS
    		if ( !empty($_POST["objectiveId"]) && !(empty($_POST["communeId"])) ) {
			
			$objective = ObjectivePeer::get($_POST["objectiveId"]);
			$commune = TableroCommunePeer::get($_POST["communeId"]);
			
			//TODO REFACTOR EN PEER
			if (!empty($objective) && !empty($commune)) {
			
				$relation = new TableroCommuneObjective();
				$relation->setCommuneId($_POST["communeId"]);
				$relation->setObjectiveId($_POST["objectiveId"]);
				
				try {
					$relation->save();				
				}
				catch (PropelException $exp) {
					$smarty->assign('errorTagId','communeMsgField');
					return $mapping->findForwardConfig('failure');				
				}
				
				$smarty->assign('commune',$commune);
				$smarty->assign('objective',$objective);
				
			}			
				return $mapping->findForwardConfig('success');

		}

		
		$smarty->assign('errorTagId','communeMsgField');
		return $mapping->findForwardConfig('failure');
	}

}

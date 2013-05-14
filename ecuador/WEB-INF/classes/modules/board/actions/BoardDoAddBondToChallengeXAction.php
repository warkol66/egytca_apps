<?php

class BoardDoAddBondToChallengeXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BoardBondRelation');
	}
	
	protected function preUpdate(){
		parent::preUpdate();
		
		if(isset($_POST['bondId']) && isset($_POST['challengeId'])){
			
			
			//TODO: agregar chequeo de que sean objetos
			
			$this->entityParams['bondId'] = $_POST['bondId'];
			$this->entityParams['challengeId'] = $_POST['challengeId'];
		}
	}

	
	protected function postUpdate(){
		parent::postUpdate();
		
	}

	function BoardDoAddBondToChallengeXAction() {
		;
	}

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

		$module = "Challenge";

		if ( !empty($_POST["bondId"]) && !(empty($_POST["challengeId"])) && isset($_SESSION['loginUser'])) {

			$bond = BoardBondQuery::create()->findOneById($_POST["bondId"]);
			$challenge = BoardChallengeQuery::create()->findOneById($_POST["challengeId"]);
			$user = $_SESSION['loginUser'];

			if (!empty($bond) && !empty($challenge)) {
				
				$isEntryTag = BoardBondRelationQuery::create()
					->filterByBondid($bond->getId())
					->filterByChallengeid($challenge->getId())
					->findOne();
				
				if(is_object($isEntryTag)){
					$smarty->assign('message','duplicate');
					return $mapping->findForwardConfig('success');
				}

				$relation = new BoardBondRelation();
				$result = $relation->setBondid($bond->getId())->setChallengeid($challenge->getId())->save();

				if ($result)
					return $mapping->findForwardConfig('success');
				else {
					$smarty->assign('message','error');
					return $mapping->findForwardConfig('success');
				}

			}
			else{
				$smarty->assign('errorTagId','tagMsgField');
				$smarty->assign('message','Puede que el desafio o el compromiso hayan sido eliminados. Refresque la página para asegurarse');
				return $mapping->findForwardConfig('success');
			}

		}

		$smarty->assign('message','error');
		return $mapping->findForwardConfig('success');
	}

}

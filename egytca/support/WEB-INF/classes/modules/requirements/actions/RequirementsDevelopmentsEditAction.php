<?php
/**
 * RequirementsDevelopmentsEditAction
 *
 * Muestra el formulario de edicion de un Desarrollo (Development)
 *
 * @package    requirements
 * @subpackage    development
 */

class RequirementsDevelopmentsEditAction extends BaseEditAction {
	
	/*function __construct() {
		parent::__construct('Development');
	}
	
	protected function postEdit() {
		parent::postEdit();
	}*/
	
	function RequirementsDevelopmentsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Requirements";
		$smarty->assign("module",$module);
		$section = "Developments";
		$smarty->assign("section",$section);

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$id = $request->getParameter("id");
		$smarty->assign("id",$id);
		
		if (!empty($id)) {
			$development = DevelopmentQuery::create()->findOneById($id);
				if (empty($development))
					$smarty->assign("notValidId","true");
			$action = "edit";
			//$attendants = array();
		}
		else{
			$development = new Development();
			$action = "create";
			
		}
		
		/*$attendants = UserQuery::create()
				->getName()
				->find();*/

		//$users = UserQuery::create()->getAll();

		$smarty->assign("development",$development);
		$smarty->assign("action",$action);
		//$smarty->assign("attendants",$attendants);
		return $mapping->findForwardConfig('success');
	}

}

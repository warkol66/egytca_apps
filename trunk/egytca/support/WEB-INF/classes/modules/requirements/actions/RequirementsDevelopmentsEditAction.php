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
		
		//caso: editar development
		if (!empty($id)) {
			
			$development = DevelopmentQuery::create()->findOneById($id);
			
			//caso: no existe development con ese id
			if (empty($development)){
				
				$smarty->assign("notValidId","true");
				$smarty->assign("action","create");
			
			}
			//caso: existe el development
			else{
				
				$smarty->assign("action","edit");
				
				$attendants = UserQuery::create()
					->orderByName()
					->findByActive(1);
					
				$smarty->assign("attendants",$attendants);					
			}
		}
		//caso: crear nuevo development
		else{
			
			$development = new Development();
			$smarty->assign("action","create");
			
		}

		$smarty->assign("development",$development);

		return $mapping->findForwardConfig('success');
	}

}

<?php
/**
 * RequirementsDoDeleteAttendantXAction
 *
 * Elimina Recurso (Attendant)
 *
 */

/*class RequirementsDoDeleteAttendantXAction extends BaseDoDeleteAction{
	
	function __construct() {
		parent::__construct('Attendant');
	}
	
}*/
class RequirementsDoDeleteAttendantXAction extends BaseAction{

	 function execute($mapping, $form, &$request, &$response) {
		BaseAction::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
				$smarty =& $this->actionServer->getPlugIn($plugInKey);
				if($smarty == NULL) {
					echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
				}
				
				$id = $request->getParameter("id");
				if (!empty($id)) {
					$attendant = BaseQuery::create('Attendant')->findOneById($id);
					//$user = BaseQuery::create('User')->findOneById();
					$user = $attendant->getUser();
					if (is_null($attendant)) {
						//Elijo la vista basado en si es o no un pedido por AJAX
						if ($this->isAjax()) {
							throw new Exception(); // Buscar una mejor forma de que falle AJAX
						} else {
							$smarty->assign('notValidId', 'true');
							return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success');
						}
					}
					
				}
				
				try {
					$attendant->delete();
						//return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success');
				} catch (Exception $e) {
					if (ConfigModule::get("global","showPropelExceptions")){
						print_r($e->__toString());
					}
				}
				
				$smarty->assign("message",$_POST["message"]);
				$smarty->assign("attendant",$user);
				return $mapping->findForwardConfig('success');
		}
}

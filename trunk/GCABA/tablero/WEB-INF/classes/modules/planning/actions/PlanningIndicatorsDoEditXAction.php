<?php
/**
 * PlanningIndicatorsDoEditXAction
 *
 * Crea o guarda cambios via AJAX de Indicadores de Planeamiento (PlanningIndicator)
 *
 * @package    planning
 * @subpackage    planningIndicators
 */

/* require_once 'BaseDoEditAction.php';

class PlanningIndicatorsDoEditXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('PlanningIndicator');
	}

	protected function postUpdate() {
		parent::postUpdate();
		$this->smarty->assign('indicator', $this->entity);
		$logSufix = ', ' . Common::getTranslation("action: create","common");
		Common::doLog('success',$this->entity->getName(). $logSufix);
	}

}
*/

class PlanningIndicatorsDoEditXAction extends BaseAction {

	function PlanningIndicatorsDoEditXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$id = $request->getParameter("id");
		$params = $request->getParameterValues("params");
		
		if (!empty($id))
			$indicator = BaseQuery::create('PlanningIndicator')->findOneById($id);
		else
			$indicator = new PlanningIndicator();

		$indicator->fromArray($params, BasePeer::TYPE_FIELDNAME);

		try {
			$indicator->save();
		} catch (Exception $e) {
			return $mapping->findForwardConfig('failure');
			if (ConfigModule::get("global","showPropelExceptions")){
				print_r($e->__toString());
			}
		}

		$smarty->assign('indicator', $indicator);

		$logSufix = ', ' . Common::getTranslation("action: create","common");
		Common::doLog('success',$indicator->getName(). $logSufix);
		return $mapping->findForwardConfig('success');

	}

}
<?php
/**
 * PlanningMeasureUnitsDoEditXAction
 *
 * Guarda Unidades de Medida basado en BaseDoEditAction
 */
/* require_once 'BaseDoEditAction.php';

class PlanningMeasureUnitsDoEditXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('PlanningMeasureUnit');
	}

	protected function postUpdate() {
		parent::postUpdate();
		$this->smarty->assign('measureUnit', $this->entity);
		$logSufix = ', ' . Common::getTranslation("action: create","common");
		Common::doLog('success',$this->entity->getName(). $logSufix);
	}

}
*/
class PlanningMeasureUnitsDoEditXAction extends BaseAction {

	function PlanningMeasureUnitsDoEditXAction() {
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
			$measureUnit = BaseQuery::create('PlanningMeasureUnit')->findOneById($id);
		else
			$measureUnit = new PlanningMeasureUnit();

		$measureUnit->fromArray($params, BasePeer::TYPE_FIELDNAME);

		try {
			$measureUnit->save();
		} catch (Exception $e) {
			return $mapping->findForwardConfig('failure');
			if (ConfigModule::get("global","showPropelExceptions")){
				print_r($e->__toString());
			}
		}

		$smarty->assign('measureUnit', $measureUnit);

		$logSufix = ', ' . Common::getTranslation("action: create","common");
		Common::doLog('success',$measureUnit->getName(). $logSufix);
		return $mapping->findForwardConfig('success');

	}

}
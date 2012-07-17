<?php
/**
 * CommonMeasureUnitsDoEditXAction
 *
 * Guarda Unidades de Medida basado en BaseDoEditAction
 */
/* require_once 'BaseDoEditAction.php';

class CommonMeasureUnitsDoEditXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('MeasureUnit');
	}

	protected function postUpdate() {
		parent::postUpdate();
		$this->smarty->assign('measureUnit', $this->entity);
		$logSufix = ', ' . Common::getTranslation("action: create","common");
		Common::doLog('success',$this->entity->getName(). $logSufix);
	}

}
*/
class CommonMeasureUnitsDoEditXAction extends BaseAction {

	function CommonMeasureUnitsDoEditXAction() {
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
			$measureUnit = BaseQuery::create('MeasureUnit')->findOneById($id);
		else
			$measureUnit = new MeasureUnit();
		
		if (isset($params['code']) && $params['code'] != $measureUnit->getCode() &&
				BaseQuery::create('MeasureUnit')->filterByCode($params['code'])->count() > 0)
			return $this->returnAjaxFailure('ya existe una unidad de medida con ese c&oacute;digo');

		$measureUnit->fromArray($params, BasePeer::TYPE_FIELDNAME);

		try {
			$measureUnit->save();
		} catch (Exception $e) {
			return $this->returnAjaxFailure();
		}

		$smarty->assign('measureUnit', $measureUnit);

		$logSufix = ', ' . Common::getTranslation("action: create","common");
		Common::doLog('success',$measureUnit->getName(). $logSufix);
		return $mapping->findForwardConfig('success');

	}

}
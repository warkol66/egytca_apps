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

		$measureUnit->fromArray($params, BasePeer::TYPE_FIELDNAME);

		try {
			if ($measureUnit->validate()) {
				$measureUnit->save();
				return;
			} else {
				foreach ($measureUnit->getValidationFailures() as $f) {	
					// solo quiero el primero
					$failure = $f;
					break;
				}
				return $this->returnAjaxFailure($failure->getMessage());
			}
		} catch (Exception $e) {
			return $this->returnAjaxFailure($e->getMessage());
		}

		$smarty->assign('measureUnit', $measureUnit);

		$logSufix = ', ' . Common::getTranslation("action: create","common");
		Common::doLog('success',$measureUnit->getName(). $logSufix);
		return $mapping->findForwardConfig('success');

	}

}
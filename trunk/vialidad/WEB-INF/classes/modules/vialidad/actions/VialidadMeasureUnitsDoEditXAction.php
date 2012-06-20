<?php
/**
 * VialidadMeasureUnitsDoEditXAction
 *
 * Guarda Unidades de Medida basado en BaseDoEditAction
 */
/*require_once 'BaseDoEditAction.php';

class VialidadMeasureUnitsDoEditXAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('MeasureUnit');
	}

	protected function postUpdate() {
		parent::postUpdate();
		if (mb_strlen($this->entity->getName()) > 120)
			$cont = " ... ";
		$logSufix = "$cont, " . Common::getTranslation('action: edit','common');
		Common::doLog('success', substr($this->entity->getName(), 0, 120) . $logSufix);
	}

}
*/
class VialidadMeasureUnitsDoEditXAction extends BaseAction {

	function VialidadMeasureUnitsDoEditXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$userParams = Common::userInfoToDoLog();
		$params = array_merge_recursive($_POST["params"],$userParams);

		$id = $request->getParameter("id");
		
		if (!empty($id))
			$measureUnit = BaseQuery::create('MeasureUnit')->findOneById($id);
		else
			$measureUnit = new MeasureUnit();

		$measureUnit->fromArray($params, BasePeer::TYPE_FIELDNAME);
		try {
			$measureUnit->save();
		} catch (Exception $e) {
			return $mapping->findForwardConfig('failure');
			if (ConfigModule::get("global","showPropelExceptions")){
				print_r($e->__toString());
			}
		}

		$smarty->assign('measureUnitColl', BaseQuery::create('MeasureUnit')->find());
		return $mapping->findForwardConfig('success');
	}

}

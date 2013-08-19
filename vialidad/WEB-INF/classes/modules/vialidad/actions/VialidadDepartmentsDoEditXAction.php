<?php
/**
 * VialidadCurrenciesDoEditXAction
 *
 * Guarda Monedas basado en BaseDoEditAction
 */
/*require_once 'BaseDoEditAction.php';

class VialidadCurrenciesDoEditXAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('Currency');
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
class VialidadDepartmentsDoEditXAction extends BaseAction {

	function VialidadDepartmentsDoEditXAction() {
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
			$department = BaseQuery::create('Department')->findOneById($id);
		else
			$department = new Department();

		$department->fromArray($params, BasePeer::TYPE_FIELDNAME);
		try {
			$department->save();
		} catch (Exception $e) {
			$smarty->assign("message", "No se pudo guardar el departamento");
			return $mapping->findForwardConfig('failure');
			if (ConfigModule::get("global","showPropelExceptions")){
				print_r($e->__toString());
			}
		}

		$smarty->assign('status', 'done');
		$smarty->assign('departmentColl', BaseQuery::create('Department')->find());
		return $mapping->findForwardConfig('success');
	}

}

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
class VialidadCurrenciesDoEditXAction extends BaseAction {

	function VialidadCurrenciesUnitsDoEditXAction() {
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
			$currency = BaseQuery::create('Currency')->findOneById($id);
		else
			$currency = new Currency();

		$currency->fromArray($params, BasePeer::TYPE_FIELDNAME);
		try {
			$currency->save();
		} catch (Exception $e) {
			$smarty->assign("message", "No se pudo guardar la moneda");
			return $mapping->findForwardConfig('failure');
			if (ConfigModule::get("global","showPropelExceptions")){
				print_r($e->__toString());
			}
		}

		$smarty->assign('status', 'done');
		$smarty->assign('currencyColl', BaseQuery::create('Currency')->find());
		return $mapping->findForwardConfig('success');
	}

}

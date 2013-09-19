<?php
/**
 * VialidadCurrenciesDoDeleteAction
 *
 * Eliminar Monedas basado en BaseDoDeleteAction
 */

class VialidadCurrenciesDoDeleteAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$id = $request->getParameter('id');
		$currency = CurrencyQuery::create()->findOneById($id);

		if (!empty($currency)) {
			$contractsCount = ContractAmountQuery::create()->filterByCurrency($currency)->count();
			if ($contractsCount == 0) {
				$currency->delete();
				if ($currency->isDeleted()) {
					if (mb_strlen($currency->getName()) > 120)
						$cont = " ... ";
					$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
					Common::doLog('success', substr($currency->getName(), 0, 120) . $logSufix);
					return $mapping->findForwardConfig('success');
				}
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}

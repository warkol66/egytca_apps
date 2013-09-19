<?php
/**
 * VialidadMeasureUnitsDoDeleteAction
 *
 * Eliminar Unidades de Medida basado en BaseDoDeleteAction
 */

class VialidadMeasureUnitsDoDeleteAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$id = $request->getParameter('id');
		$measureUnit = MeasureUnitQuery::create()->findOneById($id);

		if (!empty($measureUnit)) {
			$constructionItemCount = ConstructionItemQuery::create()->filterByMeasureUnit($measureUnit)->count();
			$constructionCount = ConstructionQuery::create()->filterByMeasureUnit($measureUnit)->count();
			$supplyCount = SupplyQuery::create()->filterByMeasureUnit($measureUnit)->count();
			if ($constructionItemCount == 0 && $constructionCount == 0 && $supplyCount == 0) {
				$measureUnit->delete();
				if ($measureUnit->isDeleted()) {
					if (mb_strlen($measureUnit->getName()) > 120)
						$cont = " ... ";
					$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
					Common::doLog('success', substr($measureUnit->getName(), 0, 120) . $logSufix);
					return $mapping->findForwardConfig('success');
				}
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}

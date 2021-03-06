<?php
/**
 * CommonMeasureUnitsDoDeleteXAction
 *
 * Eliminar Unidades de Medida basado en BaseDoDeleteAction
 */
require_once 'BaseDoDeleteAction.php';

class CommonMeasureUnitsDoDeleteXAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('MeasureUnit');
	}

	protected function postDelete() {
		parent::postDelete();
		if ($this->entity->isDeleted()) {
			if (mb_strlen($this->entity->getName()) > 120)
				$cont = " ... ";
			$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
			Common::doLog('success', substr($this->entity->getName(), 0, 120) . $logSufix);
		}
	}

}

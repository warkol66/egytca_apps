<?php
/**
 * CalendarAxisDoEditAction
 *
 * Guardar cambios en Ejes de Gestion basado en BaseDoEditAction
 */
require_once 'BaseDoEditAction.php';

class CalendarAxisDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('CalendarAxis');
	}

	protected function postUpdate() {
		parent::postUpdate();
		if (mb_strlen($this->entity->getName()) > 120)
			$cont = " ... ";
		$logSufix = "$cont, " . Common::getTranslation('action: edit','common');
		Common::doLog('success', substr($this->entity->getName(), 0, 120) . $logSufix);
	}

}

<?php
/**
 * CalendarEventTypesDoDeleteAction
 *
 * Eliminar Ejes de Gestion basado en BaseDoDeleteAction
 */
require_once 'BaseDoDeleteAction.php';

class CalendarEventTypesDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('EventType');
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
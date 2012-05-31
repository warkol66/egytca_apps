<?php

class ConstructionsInspectionsDoDeleteAction extends BaseAction {

	function ConstructionsInspectionsDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$id = $request->getParameter('id');
    if (!empty($id)) {
			$object = BaseQuery::create('Inspection')->findOneById($id);
			if (!empty($object)) {
		    $object->delete();
				if ($object->isDeleted()) {
					if (mb_strlen($object->getName()) > 120)
						$cont = " ... ";
					$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
					Common::doLog('success', substr($object->getName(), 0, 120) . $logSufix);
					return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');
				}
			}
		}
		return $this->addFiltersToForwards($_POST['filters'],$mapping,'failure');
	}

}
<?php

class AffiliatesClientsDoDeleteAction extends BaseAction {

	function AffiliatesClientsDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$id = $request->getParameter('id');
		$affiliate = ClientQuery::create()->findOneById($id);

		if (!empty($affiliate)) {

			$affiliate->delete();

			if ($affiliate->isDeleted()) {

				if (mb_strlen($affiliate->getName()) > 120)
					$cont = " ... ";

				$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
				Common::doLog('success', substr($affiliate->getName(), 0, 120) . $logSufix);

				return $mapping->findForwardConfig('success');
			}

		}
		return $mapping->findForwardConfig('failure');

	}

}

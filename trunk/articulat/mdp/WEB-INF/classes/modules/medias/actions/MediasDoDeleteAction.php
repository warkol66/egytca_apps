<?php

class MediasDoDeleteAction extends BaseAction {

	function MediasDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		if (isset($_POST["id"])) {
			$media = MediaQuery::create()->findPK($_POST["id"]);
			if (!empty($media)) {
				if ($media->countHeadlines() > 0)
					return $mapping->findForwardConfig('failure');
				else
					$media->delete();
				if ($media->isDeleted()) {
					if (mb_strlen($media->getName()) > 120)
						$cont = " ... ";

					$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
					Common::doLog('success', substr($media->getName(), 0, 120) . $logSufix);

					return $mapping->findForwardConfig('success');
				}
				else
					return $mapping->findForwardConfig('failure');
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}

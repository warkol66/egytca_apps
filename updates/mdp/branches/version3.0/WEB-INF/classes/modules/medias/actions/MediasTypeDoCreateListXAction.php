<?php

class MediasTypeDoCreateListXAction extends BaseAction {

	function MediasTypeDoCreateListXAction() {
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
		$mediaTypeParams = array_merge_recursive(array('name' => $_POST['name']), $userParams);

        $mediaType = new MediaType();
        $mediaType = Common::setObjectFromParams($mediaType, $mediaTypeParams);
        if (!$mediaType->save())
            return $this->returnFailure($mapping,$smarty,$mediaType);
        
        $smarty->assign("mediaType", $mediaType);

        $logSufix = ', ' . Common::getTranslation('action: create','common');
        Common::doLog('success', $_POST["params"]["name"] . ", " . $_POST["params"]["name"] . $logSufix);

        return $mapping->findForwardConfig('success');
	}

}

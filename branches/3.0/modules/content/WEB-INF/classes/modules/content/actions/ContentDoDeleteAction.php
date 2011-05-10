<?php
/**
* ContentDoDeleteAction
* Elimina un contenido
* @package  content
*/

class ContentDoDeleteAction extends BaseAction {

	function ContentDoDeleteAction() {
		;
	}

	function getForward($forward,$sectionId,$mapping) {

		$myRedirectConfig = $mapping->findForwardConfig($forward);
		$myRedirectPath = $myRedirectConfig->getpath();
		$queryData = '&id_section='.$sectionId;
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;

	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Content";
		$content = new Content();
		$result = false; //resultado de la operacion

		if (isset($_POST['id'])) {
			$contentToDelete = $content->getContent($_POST['id']);
			$result = $content->deleteContent($contentToDelete);
		}

		if ($result)
			return $this->getForward("success",$contentToDelete['parent'],$mapping);

		return $this->getForward("failure",$contentToDelete['parent'],$mapping);

	}

}

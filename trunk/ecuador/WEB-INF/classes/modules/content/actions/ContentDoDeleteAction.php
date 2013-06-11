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

	function getForward($forward, $sectionId, $mapping) {

		$myRedirectConfig = $mapping->findForwardConfig($forward);
		$myRedirectPath = $myRedirectConfig->getpath();
		$queryData = '&sectionId=' . $sectionId;
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;

	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if ($smarty == NULL) {
			echo 'No PlugIn found matching key: ' . $plugInKey . "<br>\n";
		}
		$this->template->template = 'TemplateJQuery.tpl';

		$module = "Content";

		if (isset($_POST['id'])) {
			$contentToDelete = ContentQuery::create()->findOneById($_POST['id']);
			$contentToDelete->delete();
			if ($contentToDelete->isDeleted())
				return $this->getForward("success", $_POST['sectionId'], $mapping);
		}
		return $this->getForward("failure", $_POST['sectionId'], $mapping);
	}
}

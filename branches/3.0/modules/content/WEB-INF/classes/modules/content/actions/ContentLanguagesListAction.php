<?php
/**
* ContentListAction
* Listado de los distintos contenidos y secciones.
* @package  content
*/

class ContentLanguagesListAction extends BaseAction {

	function ContentLanguagesListAction() {
		;
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

		$smarty->assign("message",$_GET['message']);
		$module = "Content";
		$smarty->assign("module",$module);

		$content = new Content();

		$languages = $content->getActiveLanguages();
		$inactiveLanguages = $content->getInactiveLanguageCodes();

		$smarty->assign('languages',$languages);
		$smarty->assign('inactiveLanguages',$inactiveLanguages);
		return $mapping->findForwardConfig('success');

	}

}

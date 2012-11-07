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
        $this->template->template = 'TemplateJQuery.tpl';

		$smarty->assign("message",$_GET['message']);
		$module = "Content";
		$smarty->assign("module",$module);



		$languages = ContentActiveLanguageQuery::create()->filterByActive(1)->find();
		$inactiveLanguages = ContentActiveLanguageQuery::create()->filterByActive(0)->find();

		$smarty->assign('languages',$languages);
		$smarty->assign('inactiveLanguages',$inactiveLanguages);
		return $mapping->findForwardConfig('success');

	}

}

<?php

/**
* TemplatesEditAction
*
* Action que permite ver los datos correspondientes de un documento que pueden modificarse
*
* @package templates
*/

class TemplatesEditAction extends BaseAction {

	function TemplatesEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Templates";
		$smarty->assign("module",$module);

		$smarty->assign("templatesUpload", true); //en el template se realizan subidas de documentos

		$maxUploadSize =  Common::maxUploadSize();
		$smarty->assign("maxUploadSize",$maxUploadSize);

		$id = $request->getParameter("id");

		//caso de edicion de un documento
		if (isset($_REQUEST['id']))
			$template = TemplateQuery::create()->findOneById($id);
		else
			$template = new Template();

		$smarty->assign("template",$template);
		$smarty->assign("date",date("d/m/y"));
		return $mapping->findForwardConfig('success-upload');

	}

}

<?php
/**
* ContentShowAction
* Muestra un contenido
* @package  content
*/

class ContentShowAction extends BaseAction {

	function ContentShowAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Use a different template
		$this->template->template = "TemplateContent.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Content";
		$smarty->assign("module",$module);
		$moduleConfig = Common::getModuleConfiguration($module);

		$content = new Content();

		if (isset($_GET['formId'])) {
			$form = FormPeer::get($_GET['formId']);
			$message = $form->getRedirectMessage();
			$smarty->assign('formMessage',$message);
		}

		if ((!isset($_GET['formId'])) && isset($_GET['captchaError']))
			//se produjo un error de captcha
			$smarty->assign('capchaError',1);

		$contentHomeId = $moduleConfig["home"];
		//Si no viene id como parametro, muestro el home
		if (isset($_GET['id']))
			$id = $_GET['id'];
		else if (!isset($_GET['id']) || $_GET['id']<=0)
			$id = $contentHomeId;

		$smarty->assign('contentId',$id);
		$contentData = $content->get($id);

		if (empty($contentData)) {
			$contentData = $content->get($contentHomeId);
			$smarty->assign(true,$invalidContentId);
		}
		if (preg_match('/\{setFormId_[0-9]*\}/',$contentData['content'],$regs)) {
			$formPeer = new FormPeer();
			$contentData['content'] = stripslashes($formPeer->processForms($contentData['content']));
		}

		$smarty->assign("contentData",$contentData);
		$smarty->assign("parentId",$contentData['parent']);

		//El home puede usar template interno y externo distinto
		if ($contentHomeId == $contentData["id"]) {
			if ($moduleConfig["useDifferentHomeTemplate"]["value"] == "YES") {
				$this->template->template = "TemplateContentHome.tpl";
				return $mapping->findForwardConfig('home');
			}
			return $mapping->findForwardConfig('success');
		}

		return $mapping->findForwardConfig('success');
	}

}

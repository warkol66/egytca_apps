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

		$this->template->template = 'TemplateContent.tpl';

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}


		$module = "Content";
		$smarty->assign("module",$module);
		$moduleConfig = Common::getModuleConfiguration($module);

		$content = new Content();

		$contentHomeId = $moduleConfig["home"];
		//Si no viene id como parametro, muestro el home
		if (isset($_GET['id']))
			$id = $_GET['id'];
		else if (!isset($_GET['id']) || $_GET['id']<=0)
			$id = $contentHomeId;

		$smarty->assign('contentId',$id);
		$content=ContentQuery::create()->findPk($id);

		if (!$content){
			$smarty->assign("notValidId", 1);
			return $mapping->findForwardConfig('success');
		}

		if (isset($_GET["lang"])){
			if (is_numeric($_GET["lang"]))
				$language=ContentActiveLanguageQuery::create()->findPk($_GET["lang"]);
			else
				$language=ContentActiveLanguageQuery::create()->filterByLanguagecode($_GET["lang"])->findOne();
		}
		if (!$language)
			$language=ContentActiveLanguageQuery::getDefaultLanguage();

		$content->setLocale($language->getLanguagecode());
		$smarty->assign("content",$content);

		//El home puede usar template interno y externo distinto
		if ($contentHomeId == $content->getId()) {
			if ($moduleConfig["useDifferentHomeTemplate"]["value"] == "YES") {
				$this->template->template = "TemplateContentHome.tpl";
				return $mapping->findForwardConfig('home');
			}
			return $mapping->findForwardConfig('success');
		}

		return $mapping->findForwardConfig('success');
	}

}

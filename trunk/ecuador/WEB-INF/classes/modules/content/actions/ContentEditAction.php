<?php
/**
* ContentEditAction
* Muestra el formulario para permitir la edición de un contenido
* @package  content
*/

class ContentEditAction extends BaseAction {

	function ContentEditAction() {
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

		$module = "Content";
		$smarty->assign("module",$module);

		if (class_exists('FormPeer')) {
			$forms = FormPeer::getAll();
			$smarty->assign('forms',$forms);
		}
		$content = new Content();

		$languages = $content->getActiveLanguages();
		$smarty->assign('languages',$languages);

		if (isset($_GET['id']))
			$contentType = $content->getType($_GET['id']);


		if ((isset($_GET['id']))) {

			$sections = $content->getSections();
			$smarty->assign("sections",$sections);
			$smarty->assign("type",$content->getTypeName($contentType));

			if ($contentType == Content::TYPE_SECTION) {
				$section = $content->getFullSection($_GET['id']);
				$smarty->assign("section",$section);
			}
			elseif ($contentType == Content::TYPE_CONTENT) {
				$contents = $content->getFullContent($_GET['id']);
				$smarty->assign("content",$contents);
			}
			elseif ($contentType == Content::TYPE_LINK) {
				$link = $content->getFullLink($_GET['id']);
				$smarty->assign("content",$link);
			}

			$smarty->assign("navigationChain",$content->getNavigationChain($content->get($_GET['id'])));
			return $mapping->findForwardConfig('success');
		}

		//es la creacion de un contenido o seccion
		//solamente esta seteado el tipo a crear
		if (isset($_GET['type']) && isset($_GET['parentId'])) {

			$smarty->assign("type",$_GET['type']);
			$smarty->assign("parentId",$_GET['parentId']);
			$smarty->assign("navigationChain",$content->getNavigationChain($content->get($_GET['parentId'])));
			if (isset($_GET['operation']) != "edit")
				$smarty->assign("create",true);
			return $mapping->findForwardConfig('success');

		}

		 return $mapping->findForwardConfig('failure');
	}

}

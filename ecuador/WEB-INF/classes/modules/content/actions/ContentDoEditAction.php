<?php
/**
* ContentDoEditAction
* Guarda los cambios realizados a un contenido
* @package  content
*/

class ContentDoEditAction extends BaseAction {

	function ContentDoEditAction() {
		;
	}

	function getForward($forward,$sectionId,$mapping) {

		$myRedirectConfig = $mapping->findForwardConfig($forward);
		$myRedirectPath = $myRedirectConfig->getpath();
		$queryData = '&sectionId='.$sectionId;
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;

	}

	function addSlasshesToContent($content) {

		$languages = $content->getActiveLanguageCodes();
		foreach ($languages as $eachLanguage) {
			$languageCode = $eachLanguage['languageCode'];
			$_POST['content'][$languageCode]['title'] = addslashes($_POST['content'][$languageCode]['title']);
			$_POST['content'][$languageCode]['titleInMenu'] = addslashes($_POST['content'][$languageCode]['titleInMenu']);
			$_POST['content'][$languageCode]['content'] = addslashes($_POST['content'][$languageCode]['content']);
		}

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

		if (!get_magic_quotes_gpc() || !get_magic_quotes_runtime())
			$this->addSlasshesToContent($content);

		//	casos de edición de contenidos y secciones existentes
		if (isset($_POST['content']['id']) && isset($_POST['content']['type'])) {

			$res = $_POST['content'];

			if ($_POST['content']['type'] == "section") {
				if ($content->updateSection($_POST['content']))
					return $this->getForward("success",$res['parent'],$mapping);
				return $this->getForward("failure",$res['parent'],$mapping);
			}

			if (($_POST['content']['type'] == "content") || ($_POST['content']['type'] == "link")) {
				if ($_POST['content']['type'] == 'content')
					if ($content->updateContent($_POST['content']))
						return $this->getForward("success",$res['parent'],$mapping);
					else
						return $this->getForward("failure",$res['parent'],$mapping);

				if ($_POST['content']['type'] == 'link')
					if ($content->updateLink($_POST['content']))
						return $this->getForward("success",$res['parent'],$mapping);

				return $this->getForward("failure",$res['parent'],$mapping);

			}
		}

		// casos de creación de nuevos contenidos y secciones
		elseif (isset($_POST['content']['type']) && isset($_POST['content']['parent'])) {

			if ($_POST['content']['type'] == "section") {
				if ($content->createSection($_POST['content']));
					return $this->getForward("success",$_POST['content']['parent'],$mapping);

				return $this->getForward("failure",$_POST['content']['parent'],$mapping);
			}

			if (($_POST['content']['type'] == "content") || ($_POST['content']['type'] == "link")) {
				if (($_POST['content']['type'] == 'content'))
					if ($content->createContent($_POST['content']))
						return $this->getForward("success",$_POST['content']['parent'],$mapping);

				if (($_POST['content']['type'] == 'link'))
					if ($content->createLink($_POST['content']))
						return $this->getForward("success",$_POST['content']['parent'],$mapping);

				return $this->getForward("failure",$_POST['content']['parent'],$mapping);

			}

			return $this->getForward("failure",$_POST['content']['parent'],$mapping);

		}

		//En caso que no haya entrado en editar o crear
		return $this->getForward("failure",$_POST['content']['parent'],$mapping);

	}
}
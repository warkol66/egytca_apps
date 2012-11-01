<?php
/**
* ContentDoDeleteAction
* Elimina un contenido
* @package  content
*/

class ContentLanguageDoDeleteAction extends BaseAction {

	function ContentLanguageDoDeleteAction() {
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
		$content = new Content();
		$result = false; //resultado de la operacion

		if (isset($_POST['languageCode']))
			$result = $content->disableLanguage($_POST['languageCode']);

		if ($result)
			return $mapping->findForwardConfig('success');

		return $mapping->findForwardConfig('failure');

	}

}

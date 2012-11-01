<?php
/**
* ContentDoEditOrderXAction
* Permite mediante Ajax el cambio de orden de lso contenidos disponibles
* @package  content
*/

class ContentDoEditOrderXAction extends BaseAction {

	function ContentDoEditOrderXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		/**
		* Use a different template
		*/
		$this->template->template = "TemplateAjax.tpl";

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
		parse_str($_POST['data']);

		for ($i = 0; $i < count($contentList); $i++)
			$content->updateOrder($contentList[$i],$i);

		return $mapping->findForwardConfig('success');

	}

}

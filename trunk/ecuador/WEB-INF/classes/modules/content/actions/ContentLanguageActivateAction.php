<?php
/**
* ContentDoDeleteAction
* Elimina un contenido
* @package  content
*/

class ContentLanguageActivateAction extends BaseAction {

	function ContentLanguageActivateAction() {
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
		$id=$_POST["id"];

        $idioma=ContentActiveLanguageQuery::create()->findPk($id);

        if ($idioma){
            $idioma->setActive(1);
            $idioma->save();
            return $mapping->findForwardConfig('success');
        }

		return $mapping->findForwardConfig('failure');

	}

}

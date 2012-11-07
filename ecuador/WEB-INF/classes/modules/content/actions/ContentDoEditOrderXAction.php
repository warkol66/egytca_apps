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

        $orden=$_POST["orden"];
        $parentId=$_POST["parentId"];

        $parent=ContentQuery::create()->findPk($parentId);

        $anterior=null;

        for($i=0;$i<count($orden);$i++){
            $content=ContentQuery::create()->findPk($orden[$i]);

            if($i==0){
                $content->moveToFirstChildOf($parent);
            }
            else{
                $content->moveToNextSiblingOf($anterior);
            }
            $content->save();
            $anterior=null;
            $anterior=$content;
        }

		return $mapping->findForwardConfig('success');

	}

}

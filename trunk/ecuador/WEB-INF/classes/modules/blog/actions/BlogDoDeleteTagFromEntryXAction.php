<?php

class BlogDoDeleteTagFromEntryXAction extends BaseAction {

	function BlogDoDeleteTagFromEntryXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//por ser una action ajax.
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Blog";

		//TODO VERIFICACION USUARIOS
		if ( !empty($_POST["entryId"]) && !(empty($_POST["tagId"])) ) {

			$entry = BlogEntryPeer::get($_POST["entryId"]);
			$tag = BlogTagPeer::get($_POST["tagId"]);

			if (!empty($entry) && !empty($tag)) {
					BlogTagRelationPeer::delete($_POST["entryId"],$_POST["tagId"]);
					$smarty->assign('tag',$tag);
				}
			}
			else{
				$smarty->assign("errorTagId", "tagMsgField");
				$smarty->assign("message", "La etiqueta o la entrada son inválidas");
				return $mapping->findForwardConfig('failure');	
			}

		return $mapping->findForwardConfig('success');
	}

}

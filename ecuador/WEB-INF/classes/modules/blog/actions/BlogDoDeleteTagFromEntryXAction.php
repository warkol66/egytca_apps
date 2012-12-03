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

			$entry = BlogEntryQuery::create()->findOneById($_POST["entryId"]);
			$tag = BlogTagQuery::create()->findOneById($_POST["tagId"]);
			
			
			if (!empty($entry) && !empty($tag)) {
					$relation = BlogTagRelationQuery::create()->findOneByEntryIdAndTagId($_POST["entryId"],$_POST["tagId"])->delete();
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

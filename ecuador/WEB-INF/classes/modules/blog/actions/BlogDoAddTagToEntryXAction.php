<?php

class BlogDoAddTagToEntryXAction extends BaseAction {

	function BlogDoAddTagToEntryXAction() {
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

		if ( !empty($_POST["entryId"]) && !(empty($_POST["tagId"])) ) {

			$entry = BlogEntryPeer::get($_POST["entryId"]);
			$tag = BlogTagPeer::get($_POST["tagId"]);

			$smarty->assign('entry',$entry);
			$smarty->assign('tag',$tag);

			$relationParams["entryId"] = $_POST["entryId"];
			$relationParams["tagId"] = $_POST["tagId"];

			if (!empty($entry) && !empty($tag)) {

				$relation = new BlogTagRelationPeer();
				$result = $relation->create($relationParams);

				if ($result)
					return $mapping->findForwardConfig('success');
				else {
					$smarty->assign('errorTagId','tagMsgField');
					return $mapping->findForwardConfig('failure');
				}

			}
			else{
				$smarty->assign('errorTagId','tagMsgField');
				$smarty->assign('message','Puede que la entrada o la etiqueta hayan sido eliminadas. Refresque la página para asegurarse');
				return $mapping->findForwardConfig('failure');
			}

		}

		$smarty->assign('errorTagId','tagMsgField');
		return $mapping->findForwardConfig('failure');
	}

}

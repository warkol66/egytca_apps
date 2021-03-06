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

			$entry = BlogEntryQuery::create()->findOneById($_POST["entryId"]);
			$tag = BlogTagQuery::create()->findOneById($_POST["tagId"]);

			$smarty->assign('entry',$entry);
			$smarty->assign('tag',$tag);

			if (!empty($entry) && !empty($tag)) {
				
				$isEntryTag = BlogTagRelationQuery::create()->filterByEntryid($entry->getId())->filterByTagid($tag->getId())->findOne();
				/*print_r(is_object($isEntryTag));
				die();*/
				if(is_object($isEntryTag)){
					$smarty->assign('message','duplicate');
					return $mapping->findForwardConfig('success');
				}

				$relation = new BlogTagRelation();
				$result = $relation->setEntryid($entry->getId())->setTagid($tag->getId())->save();

				if ($result)
					return $mapping->findForwardConfig('success');
				else {
					$smarty->assign('message','error');
					return $mapping->findForwardConfig('success');
				}

			}
			else{
				$smarty->assign('errorTagId','tagMsgField');
				$smarty->assign('message','Puede que la entrada o la etiqueta hayan sido eliminadas. Refresque la página para asegurarse');
				return $mapping->findForwardConfig('success');
			}

		}

		$smarty->assign('message','error');
		return $mapping->findForwardConfig('success');
	}

}

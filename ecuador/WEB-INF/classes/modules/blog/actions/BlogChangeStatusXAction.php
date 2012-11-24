<?php

class BlogChangeStatusXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
	}

	/*function BlogChangeStatusXAction() {
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

		//por ser una llamada via ajax
		$this->template->template = 'TemplateAjax.tpl';

		$module = "Blog";
		$smarty->assign("module",$module);

		//caso de actualizacion de una sola noticia
		if (isset($_POST['blogEntry'])){
			$blogEntry = BlogEntryQuery::create()->findOneById($_POST['blogEntry']['id']);
			if(is_object($blogEntry)){
				$blogEntry->setStatus($_POST['blogEntry']['status']); 
				$blogEntry->save();
			}
			else{
				$smarty->assign("exists",false);
				return $mapping->findForwardConfig('success');
			}
		}

		//cambio de status de varios elementos
		if (isset($_POST['status']) && isset($_POST['selected'])) {
			foreach ($_POST['selected'] as $id) {
				$blogEntry = BlogEntryQuery::create()->findOneById($id);
				if(is_object($blogEntry)){
					$blogEntry->setStatus($_POST['status']); 
					$blogEntry->save();
				}
				else{
					$smarty->assign("exists",false);
					return $mapping->findForwardConfig('success');
				}
			}
		}
		return $mapping->findForwardConfig('success');
	}*/

}

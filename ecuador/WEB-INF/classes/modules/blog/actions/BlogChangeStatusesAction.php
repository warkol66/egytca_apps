<?php

class BlogChangeStatusesAction extends BaseDoEditAction {
	
	/*function __construct() {
		parent::__construct('BlogEntry');
	}
	* Arreglar para que edite mas de una entidad
	* */

	function BlogChangeStatusesAction() {
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

		//cambio de status de varios elementos
		if (isset($_POST['status']) && isset($_POST['selected'])) {

			foreach ($_POST['selected'] as $id) {
				$blogEntry = BlogEntryQuery::create()->findOneById($id);
				if(is_object($blogEntry)){
					$blogEntry->setStatus($_POST['status']); 
					$blogEntry->save();
				}
			}
		}

		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		if ($_POST['page'])
			$queryData = '&page='.$_POST["page"];

		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;


	}

}

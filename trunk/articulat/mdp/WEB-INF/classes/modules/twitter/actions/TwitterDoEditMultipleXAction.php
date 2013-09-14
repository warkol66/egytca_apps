<?php

class TwitterDoEditMultipleXAction extends BaseAction {

	function TwitterDoEditMultipleXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = 'Twitter';
		$smarty->assign("module",$module);
		$field = $_REQUEST["field"];
		$newValue = $_REQUEST["newValue"];
		
		//isset($_POST['selected'])

		if (!empty($_POST['selected'])){

			if(TwitterTweet::editMultiple($field,$newValue,$_POST['selected'])){
				$smarty->assign('field',$field);
				$smarty->assign('tweets',$_POST['selected']);
				return $mapping->findForwardConfig('success');
			}else{
				
			}

		}
			
		$smarty->assign("error",'true');
		return $mapping->findForwardConfig('success');
	}
}

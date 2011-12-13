<?php

class HtmlsDoEditAction extends BaseAction {

	function HtmlsDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = 'HTMLS';
		$smarty->assign("module",$module);

		$smarty->assign("uploaded",true);

		if (!empty($_POST["name"])) {

			$fileName = $_POST["name"];
			$replacedName = str_replace(" ", "_", $fileName);

			if ($_POST["external"]==1)
				$filename="WEB-INF/tpl/htmls_" . $replacedName . "_external.tpl";
			else {
				if ($_POST["private"]==1)
					$filename="WEB-INF/tpl/htmls_private_".$replacedName . ".tpl";
				else
					$filename="WEB-INF/tpl/htmls_" . $replacedName . ".tpl";
			}

			if (move_uploaded_file($_FILES['document']['tmp_name'],$filename)) {
				if ($_POST["private"]==1)
					$smarty->assign("link","Main.php?do=htmlsShowPrivate&name=" . $replacedName);
				else
					$smarty->assign("link","Main.php?do=htmlsShow&name=" . $replacedName);
			}
			else
				$smarty->assign("uploadError",true);
		}
		else
			$smarty->assign("uploadError",true);

		return $mapping->findForwardConfig('success');

	}

}

<?php

class IndicatorsXsDoEditAction extends BaseAction {

	function IndicatorsXsDoEditAction() {
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

		$module = "Indicators";
		$smarty->assign("module",$module);
		if ($_POST['disbursement']){
			$smarty->assign("disbursement",true);
			$smarty->assign("module","Projects");
			$forwardParams = array("id" => $_POST["indicatorId"], "disbursement" => 1);
		}
		else
			$forwardParams = array("id" => $_POST["indicatorId"]);
		

		$indicatorXPeer = new IndicatorXPeer();

		if ( !empty($_POST["indicatorId"]) ) {
			$xsUpdated = $_POST["xLabel"];
			foreach($xsUpdated['id'] as $i => $xUpdated) {
				if (!empty($xsUpdated['name'][$i])) {
					$params = array();				
					$params['name'] = $xsUpdated['name'][$i];
					$params['indicatorId'] = $_POST["indicatorId"];
					if ($xsUpdated['id'][$i] <= "0") {
						//para que el nuevo elemento quede al final de todo.
						$params['order'] = 9999;
						$indicatorXPeer->create($params);
					}
					else 
						$indicatorXPeer->update($xsUpdated['id'][$i], $params);
				}
			}
		}

		$smarty->assign("message",$_GET["message"]);
		return $this->addParamsToForwards($forwardParams,$mapping,'success');
	}

}

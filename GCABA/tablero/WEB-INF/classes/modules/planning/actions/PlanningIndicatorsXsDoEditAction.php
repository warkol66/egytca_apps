<?php

class PlanningIndicatorsXsDoEditAction extends BaseAction {

	function PlanningIndicatorsXsDoEditAction() {

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

		if ( !empty($_POST["indicatorId"]) ) {
			$xsUpdated = $_POST["xLabel"];
			foreach($xsUpdated['id'] as $i => $xUpdated) {
				if (!empty($xsUpdated['name'][$i])) {
					$params = array();				
					$params['Name'] = $xsUpdated['name'][$i];
					$params['Indicatorid'] = $_POST["indicatorId"];
                    $params['Order'] = $i+1;
					if ($xsUpdated['id'][$i] <= "0") {
						//para que el nuevo elemento quede al final de todo.
						$xObj=new PlanningIndicatorX();
                        $xObj->setName($params['Name']);
                        $xObj->setIndicatorid($params['Indicatorid']);
                        $xObj->setOrder($params['Order']);
                        $xObj->setOldid(0);
                        $xObj->save();
					}
					else 
						PlanningIndicatorXQuery::create()->filterById($xsUpdated['id'][$i])->update($params);
				}
			}
		}

		$smarty->assign("message",$_GET["message"]);
		return $this->addParamsToForwards($forwardParams,$mapping,'success-edit');
	}

}

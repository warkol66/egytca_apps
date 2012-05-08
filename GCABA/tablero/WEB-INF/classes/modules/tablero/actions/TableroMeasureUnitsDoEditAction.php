<?php

class TableroMeasureUnitsDoEditAction extends BaseAction {

	function TableroMeasureUnitsDoEditAction() {
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

		$module = "Tablero";
    $smarty->assign("module",$module);

		$section = "MeasureUnits";
    $smarty->assign("section",$section);
		$params = $_POST["measureUnit"];
		$pagerRedirect = array ( "page" => $_POST["page"]);

		if ( $_POST["action"] == "edit" ) {
			if ( TableroMeasureUnitPeer::update($_POST["id"],$_POST["measureUnit"]) )
				return $this->addParamsToForwards($pagerRedirect,$mapping,'success');
      else
				return $this->addParamsToForwards($pagerRedirect,$mapping,'failure');
		}
		else {
      if ( !TableroMeasureUnitPeer::create($params) ) {
				$smarty->assign("id",$_POST["id"]);
				$smarty->assign("measureUnit",$_POST["measureUnit"]);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $this->addParamsToForwards($pagerRedirect,$mapping,'failure');
      }

			return $this->addParamsToForwards($pagerRedirect,$mapping,'success');
		}

	}

}

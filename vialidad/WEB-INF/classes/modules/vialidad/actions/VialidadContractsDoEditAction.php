<?php

class VialidadContractsDoEditAction extends BaseAction {

	function VialidadContractsDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "Contracts";
		$smarty->assign("section",$section);

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		foreach ($_POST["amount"] as $item) {

			foreach ($item as $itemValue => $value) {
				if ($itemValue == "amount" || $itemValue == "paripassu" ) 
					$value = Common::convertToMysqlNumericFormat($value);
				$amountValues[$itemValue] = $value;
			}
			//Cuando complete todos los valores asociados a un monto, lo guardo en $amountParams
			if ($itemValue == "eol") {
				$amountParams[] = $amountValues;
				$amountValues = array();
			}
		}

		//Guardo los datos de montos asociados al contrato
		foreach ($amountParams as $amount) {
		
			$id = $amount["id"];
		
			if (!empty($id))
				$contractAmount = ContractAmountQuery::create()->findOneById($id);
			else
				$contractAmount = new ContractAmount();
		
			$contractAmount->fromArray($amount,BasePeer::TYPE_FIELDNAME);
			if ($contractAmount->isNew())
				$contractAmount->setId(null);
						
		
			$contractAmount->setContractid($_POST["id"]);
			try {
				$contractAmount->save();
			} catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->__toString());
			}
		
		}


		$userParams = Common::userInfoToDoLog();
		$contractParams = array_merge_recursive($_POST["params"],$userParams);

		$smarty->assign("filters",$filters);

		if ($_POST["action"] == "edit" && !empty($_POST["id"])) {
			$params["id"] = $_POST["id"];
			$contract = ContractPeer::get($_POST["id"]);
			if (!empty($contract)) {
				$contract = Common::setObjectFromParams($contract,$_POST["params"]);

				if ($contract->isModified() && $contract->validate() && !$contract->save()) 
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
	
				$smarty->assign("message","ok");
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
			}
		}
		else {
			$contract = new Contract();
			$contract = Common::setObjectFromParams($contract,$contractParams);

			if (!$contract->save())
				return $this->returnFailure($mapping,$smarty,$contract);

			if (mb_strlen($_POST["params"]["name"]) > 120)
				$cont = " ... ";

			$logSufix = "$cont, " . Common::getTranslation('action: create','common');
			Common::doLog('success', substr($_POST["params"]["name"], 0, 120) . $logSufix);

			$params['id'] = $contract->getId();
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
		}

	}

}

<?php

class VialidadContractsDoAddSourceXAction extends BaseAction {

	function VialidadContractsDoAddSourceXAction() {
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

		$contractId = $request->getParameter('contractId');
		$sourceId = $request->getParameter('sourceId');

		if (!empty($contractId) && !empty($sourceId)) {

			$contract = ContractQuery::create()->findOneById($contractId);
			$source = SourceQuery::create()->findOneById($sourceId);

			if ($contract && $source) {
				$exist = ContractSourceQuery::create()->filterByContract($contract)->filterBySource($source)->count();
				if (empty($exist)) {
					$contractSource = new ContractSource();
					$contractSource->setContract($contract);
					$contractSource->setSource($source);
						if (!$contractSource->save())
							return $mapping->findForwardConfig('error');

					$smarty->assign('contract', $contract);
					$smarty->assign('source', $source);

					return $mapping->findForwardConfig('success');
				}
				return $mapping->findForwardConfig('error');
			}
			else {
				return $mapping->findForwardConfig('error');
			}
			return $mapping->findForwardConfig('error');
		}
		else {
			return $mapping->findForwardConfig('error');
		}
	}

}

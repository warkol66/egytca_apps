<?php

class VialidadDepartmentsDoDeleteAction extends BaseAction {

	function VialidadDepartmentsDoDeleteAction() {
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
		$section = "Department";
		$smarty->assign("section",$section);

		$id = $request->getParameter("id");
		$department = DepartmentQuery::create()->findOneById($id);

		if (!empty($department)) {
			$constructionsCount = ConstructionQuery::create()->filterByDepartment($department)->count();
			if ($constructionsCount == 0) {
				$department->delete();
				if ($department->isDeleted()) {
					if (mb_strlen($department->getName()) > 120)
						$cont = " ... ";
					$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
					Common::doLog('success', substr($department->getName(), 0, 120) . $logSufix);
		
					return $mapping->findForwardConfig('success');
				}
			}
		}
		return $mapping->findForwardConfig('failure');
	}
}

<?php

class VialidadConstructionDepartmentsDoUpdateXAction extends BaseAction {

	function VialidadConstructionDepartmentsDoUpdateXAction() {
		;
	}
	
	function arrayHasDepartment($array, $department) {
		foreach ($array as $e) {
			if ($e->getId() == $department->getId())
				return true;
		}
		return false;
	}
	
	function addDepartment($construction, $department) {
		if (!($construction->hasDepartment($department))) {
			$construction->addDepartment($department);
			if (!$construction->save()) {
				$smarty->assign('message', 'failure');
			} 
		}
	}
	
	function removeDepartment($construction, $department) {
		
		$construction = ConstructionQuery::create()->findOneById($_POST["constructionId"]);
		$relation = ConstructionDepartmentQuery::create()->filterByConstruction($construction)->filterByDepartment($department)->findOne();
		
		if (!empty($relation))
			try {
				$relation->delete();
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";

		if (!empty($_POST["constructionId"])) {
		
			$construction = ConstructionQuery::create()->findOneById($_POST["constructionId"]);
			$departmentsIds = $_POST["departmentsIds"];
			$selectedDepartments = array();
			
			foreach ($departmentsIds as $departmentId) {
				array_push($selectedDepartments, DepartmentQuery::create()->findOneById($departmentId)); 
			}
			$associatedDepartments = $construction->getDepartments();
			
			// Quitar los departments que sobren
			foreach ($associatedDepartments as $e) {
				if (!$this->arrayHasDepartment($selectedDepartments, $e))
					$this->removeDepartment($construction, $e);
			}
			
			// Agregar los departments que falten
			foreach ($selectedDepartments as $e) {
				if (!$this->arrayHasDepartment($associatedDepartments, $e))
					$this->addDepartment($construction, $e);
			}
			
		}

//		return $mapping->findForwardConfig('success');
die;	}

}
<?php
//TODO: REVISAR!!!!!!!
class ModulesDoActivateXAction extends BaseAction {

	function ModulesDoActivateXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$this->template->template = "TemplateAjax.tpl";
		
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		//asigno modulo y seccion
		$module = "Modules";
		$smarty->assign("module",$module);

		$modulePeer = new ModulePeer();
		$moduleDependencyPeer = new ModuleDependencyPeer();
		
		$moduleName = $_POST["module"];
		$smarty->assign("moduleName",$moduleName);
		if(!$activeModule = $_POST["activeModule"]) 
			$activeModule = 0;

	
		$savedModules= $modulePeer->getAll();
		
		//if (isset($_POST["activar"]) ){
					//////////
					// si el modulo no posee dependencias, se actualiza directamente			
				$dependencies=$moduleDependencyPeer->get($moduleName);

			if( empty($dependencies) )
				$assignedModules = $modulePeer->setActive($moduleName,$activeModule);
			
			else {
				$i=0;
				foreach ($dependencies as $dependency) {
					$dependencyName=$dependency->getDependence();
					//echo "dep: $dependencyName";
					$status=$modulePeer->dependencyStatus($dependencyName);
					//echo "status: $status";
					if ($activeModule == 1){
						if ($status == 0 ){
							$dependenciesNames[$i]=$dependencyName;
							$i++;
							$flag=1;
						}
					}
					else {
						if ($status == 1 ){
							
							$dependenciesNames[$i]=$dependencyName;
							$i++;
							$flag=2;
						}
					}			
				}// foreach
				if($flag==1){
						$smarty->assign("flag",$flag);
						$smarty->assign("dependenciesName",$dependenciesNames);
					//	doLogV2('errorDependencyOn');
						return $mapping->findForwardConfig('errorDependencyOn');
				}
				if ($flag==2){
						$smarty->assign("dependenciesName",$dependenciesNames);
					//	doLogV2('errorDependencyOff');
						return $mapping->findForwardConfig('errorDependencyOff');		
				}
				$assignedModules= $modulePeer->setActive($moduleName,$activeModule);
			} //else dependencies
	//	} //isset

		return $mapping->findForwardConfig('success');

	}

}

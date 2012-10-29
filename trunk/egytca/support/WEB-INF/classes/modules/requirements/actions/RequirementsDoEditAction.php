<?php
/**
 * RequirementsDoEditAction
 *
 * Crea o guarda cambios de requerimientos (Actor)
 *
 * @package    requirement
 */

class RequirementsDoEditAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('Requirement');
	}
	
	function postUpdate(){
		parent::postUpdate();
		
		if(!empty($_POST["params"]["developmentId"])){
			$development = DevelopmentQuery::create()->findOneById($_POST["params"]["developmentId"]);
			$client = $development->getClientid();
			
			if(!empty($client)){
				$this->entity->setClientid($client)->save();
			}else{
				$this->entity->setClientid(null)->save();
			}
		}
	}

}

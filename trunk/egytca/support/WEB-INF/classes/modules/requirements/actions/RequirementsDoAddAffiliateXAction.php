<?php
/** 
 * UsersDoAddToGroupXAction
 *
 * @package users 
 * @subpackage groups 
 */

class RequirementsDoAddAffiliateXAction extends BaseDoEditAction {
		
	public function __construct() {
		parent::__construct('Requirement');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		//$requirement = RequirementQuery::create()->findOneById($_POST["id"]);
		$affiliate = AffiliateQuery::create()->findOneById($_POST["affiliateId"]);
		
		if(!empty($_POST["affiliateId"]) && !empty($_POST["id"])){
			$this->entity->setAffiliate($affiliate)->save();
		}
		
		//$this->smarty->assign("requirement", $requirement);
		$this->smarty->assign("affiliate", $affiliate);
	}
}

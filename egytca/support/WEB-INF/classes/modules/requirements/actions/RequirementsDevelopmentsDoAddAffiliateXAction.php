<?php
/** 
 * UsersDoAddToGroupXAction
 *
 * @package users 
 * @subpackage groups 
 */

class RequirementsDevelopmentsDoAddAffiliateXAction extends BaseDoEditAction {
	
	public function __construct() {
		parent::__construct('Development');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		//$development = DevelopmentQuery::create()->findOneById($_POST["id"]);
		$affiliate = AffiliateQuery::create()->findOneById($_POST["affiliateId"]);
		
		if(!empty($_POST["affiliateId"]) && !empty($_POST["id"])){
			$this->entity->setAffiliate($affiliate)->save();
		}
		
		//$this->smarty->assign("development", $development);
		$this->smarty->assign("affiliate", $affiliate);
	}

}

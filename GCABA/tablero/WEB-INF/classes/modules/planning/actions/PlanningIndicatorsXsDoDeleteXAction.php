<?php
/**
* IndicatorsXsDoDeleteXAction
* 
* Permite mediante Ajax la eliminacion de una X.
* 
* @package  projects
*/

require_once("BaseAction.php");

class PlanningIndicatorsXsDoDeleteXAction extends BaseAction {

	function PlanningIndicatorsXsDoDeleteXAction() {

	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

    /**
    * Use a different template
    */
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Indicators";
		
		$xId = $_POST['id'];
		
		$smarty->assign("id", $xId);

        try {
            // Borrando todas Y asociadas a esta X
            PlanningIndicatorYQuery::create()->filterByXid($xId)->delete();

            PlanningIndicatorXQuery::create()->filterById($xId)->delete();
        } catch (PropelException $exp) {
            if (ConfigModule::get("global", "showPropelExceptions"))
                print_r($exp->getMessage());
            exit;
            return $mapping->findForwardConfig('failure');
        }

        return $mapping->findForwardConfig('success');

	}

}

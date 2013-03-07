<?php
/**
 * PlanningRemoveBudgetItemRelationXAction
 * Elimina relaciones de partidas presupuestarias (BudgetRelation)
 *
 * @package    planning
 * @subpackage    planningBudgetRelation
 */

/*require_once 'BaseDoDeleteAction.php';

class PlanningRemoveProgressRecordXAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('ConstructionProgress');
		$this->forwardName = "successX";
	}

}
*/
class PlanningRemoveProgressRecordXAction extends BaseAction {

	function PlanningRemoveProgressRecordXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$id = $request->getParameter("id");
		if (!empty($id)) {
			$constructionProgress = BaseQuery::create("ConstructionProgress")->findOneByID($id);
			if (!empty($constructionProgress)) {
				$constructionProgress->delete();
			}
		}
		return $mapping->findForwardConfig('success');

	}
}

<?php
/*
require_once 'BaseDoEditAction.php';

class PlanningImpactObjectivesDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('ImpactObjective');
	}
}
<?php
*/
class PlanningImpactObjectivesDoEditAction extends BaseAction {

	function PlanningImpactObjectivesDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$id = $request->getParameter("id");
		$params = $_POST["params"];

		if (!empty($id)) {
			$impactObjective = BaseQuery::create("ImpactObjective")->findOneByID($id);
			if (!empty($impactObjective)) {
				$impactObjectiveLog = new ImpactObjectiveLog();
			}
		}
		else {
			$impactObjective = new ImpactObjective();
		}

		$impactObjective->fromArray($params, BasePeer::TYPE_FIELDNAME);

		if (!$impactObjective->isNew()) {
			$impactObjectiveLog->fromJSON($impactObjective->toJSON(), BasePeer::TYPE_FIELDNAME);
			$impactObjectiveLog->setId(NULL);
			$impactObjectiveLog->setImpactObjectiveId($id);
		}

		try {
			$impactObjective->save();
			if (isset($impactObjectiveLog)) {
				try {
					$impactObjectiveLog->save();
				} catch (Exception $e) {
					if (ConfigModule::get("global","showPropelExceptions")) {
						print_r($e->__toString());
					}
				}
			}
		} catch (Exception $e) {
			if (ConfigModule::get("global","showPropelExceptions")) {
				print_r($e->__toString());
			}
			return $this->returnFailure($mapping, $smarty, $this->entity, 'failure-edit');
		}

		if (isset($id))
			$logSufix = ', ' . Common::getTranslation('action: create','common');
		else
			$logSufix = ', ' . Common::getTranslation('action: edit','common');

		Common::doLog('success', $impactObjective->getName() . $logSufix);
		return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');

	}
}

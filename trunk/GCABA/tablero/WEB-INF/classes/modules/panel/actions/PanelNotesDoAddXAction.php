<?php
/**
 * PanelProjectsDoEditAction
 *
 * Crea o guarda cambios de Proyectos (PlanningProject)
 *
 * @package    panel
 * @subpackage    planningProjects
 */

class PanelNotesDoAddXAction extends BaseAction {

	function PanelNotesDoAddXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$params = Common::addUserInfoToParams($_POST["params"]);
		$panelNote = new PanelNote();
		$panelNote->fromArray($params, BasePeer::TYPE_FIELDNAME);

		try {
			$panelNote->save();
		} catch (Exception $e) {
			if (ConfigModule::get("global","showPropelExceptions")) {
				print_r($e->__toString());
			}
			return $this->returnFailure($mapping, $smarty, $this->entity, 'failure');
		}

		$smarty->assign('panelNote', $panelNote);

		if (isset($id))
			$logSufix = ', ' . Common::getTranslation('action: create','common');
		else
			$logSufix = ', ' . Common::getTranslation('action: edit','common');

		//Common::doLog('success', $planningProject->getName() . $logSufix);
		return $mapping->findForwardConfig('success');

	}

}

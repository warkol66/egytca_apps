<?php
/**
 * PlanningProjectsUpdateIndicatorXAction
 *
 * Crea o modifica indicadores de Proyectos (PlanningProject)
 *
 * @package    planning
 * @subpackage    planningProjects
 */

class PlanningProjectsUpdateIndicatorXAction extends BaseAction {

	function PlanningProjectsUpdateIndicatorXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		
		$this->template->template = "TemplateAjax.tpl";

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if(!empty($_POST['indicatorId']) && !empty($_POST['id'])){
			
			$relation = PlanningProjectIndicatorQuery::create()->filterByPlanningProjectid($_POST['id'])->findOneOrCreate();

			$result = $relation->setIndicatorid($_POST['indicatorId'])->save();
			if($result)
				$smarty->assign('indicatorMessage', 'Indicador asociado correctamente');
			else
				$smarty->assign('indicatorMessage', 'No se pudo asociar el indicador');
			
			return $mapping->findForwardConfig('success');
		}

	}
	
}

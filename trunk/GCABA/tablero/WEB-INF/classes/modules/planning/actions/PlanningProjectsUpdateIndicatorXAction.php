<?php
/**
 * PlanningConstructionsDoEditAction
 *
 * Crea o guarda cambios de Proyectos (PlanningProject)
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
			
			$id = $_POST['id'];
			$indicator = $_POST['indicatorId'];
			
			$relation = PlanningProjectIndicatorQuery::create()->findOneByPlanningProjectid($_POST['id']);
			//si no existe, creo una nueva relacion
			if(empty($relation))
				$relation = new PlanningProjectIndicator();
			
			$result = $relation->setPlanningprojectid($id)->setIndicatorid($indicator)->save();
			if($result)
				$smarty->assign('indicatorMessage', 'Indicador asociado correctamente');
			else
				$smarty->assign('indicatorMessage', 'No se pudo asociar el indicador');
			
			return $mapping->findForwardConfig('success');
		}

	}
	
}

<?php

class PanelResultFramesIndicatorsGetValuesXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelResultFramesIndicatorsGetValuesXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$this->template->template = 'TemplateAjax.tpl';
		
		$module = 'Panel';
		$smarty->assign('module',$module);
		
		$indicatorParams = $_POST['indicatorData'];
		$indicatorParams['parent'] = ResultFrameIndicatorPeer::get($indicatorParams['parentId']);
		
		// Armamos un indicador con los datos para poder usar los métodos miembro. No lo vamos a guardar.
		if (!empty($_POST['id']))
			$indicator = ResultFrameIndicatorPeer::get($_POST['id']);
		else
			$indicator = new ResultFrameIndicator;
			
		Common::setObjectFromParams($indicator, $indicatorParams);
		
		// Esto lo hago por una deficiencia en el setObjectFromParams.
		$indicator->setObjectType($indicatorParams['objectType']);
		$indicator->setObjectId($indicatorParams['objectId']);
		
		$indicatorValues = $indicator->getValues();
		$smarty->assign('indicatorValues', $indicatorValues);

		return $mapping->findForwardConfig('success');
	}
}


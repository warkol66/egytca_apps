<?php
/**
 * PanelNotesDoDeleteXAction
 * Elimina notas (PanelNote)
 *
 * @package    panel
 * @subpackage    panelNote
 */

class PanelNotesDoDeleteXAction extends BaseAction {

	function PanelNotesDoDeleteXAction() {
	;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$id = $request->getParameter('id');
		$panelNote = BaseQuery::create('PanelNote')->findOneByID($id);
		if (!empty($panelNote)) {
			try {
				$panelNote->delete();
			} catch (PropelException $exp) {
				if (ConfigModule::get("global", "showPropelExceptions"))
						print_r($exp->getMessage());
				exit;
				return $mapping->findForwardConfig('failure');
			}
			$smarty->assign("id",$id);
			return $mapping->findForwardConfig('success');
		}
		return $mapping->findForwardConfig('failure');
	}
}

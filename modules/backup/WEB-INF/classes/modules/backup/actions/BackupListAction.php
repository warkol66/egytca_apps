<?php
/**
 * BackupListAction
 *
 * @package backup
 */

class BackupListAction extends BaseAction {

	function BackupListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Backup";
		$smarty->assign("module",$module);

		require_once("BackupPeer.php");
		$backupPeer = new BackupPeer();

		if (isset($_GET['order']) && $_GET['order'] == "desc")
			$order = "desc";

		$filenames = $backupPeer->getBackupList($order);

		$smarty->assign('order',$order);

		$smarty->assign('message',$_GET['message']);
		$smarty->assign('filenames',$filenames);

		return $mapping->findForwardConfig('success');
	}

}

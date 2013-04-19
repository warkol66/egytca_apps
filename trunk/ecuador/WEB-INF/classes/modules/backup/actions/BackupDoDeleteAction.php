<?php
/**
 * BackupDeleteAction
 *
 * @package backup
 */

class BackupDoDeleteAction extends BaseAction {

	function BackupDoDeleteAction() {
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

		if ($backupPeer->deleteBackup($_POST['filename'])) {
			Common::doLog('success','Backup deleted: ' . $_POST['filename']);
			return $mapping->findForwardConfig('success');
		}
		else {
			Common::doLog('failure','Backup not deleted: ' . $_POST['filename']);
			return $mapping->findForwardConfig('failure');
		}
	}
}

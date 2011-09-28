<?php
/**
 * BackupRestoreAction
 *
 * @package backup
 */

class BackupRestoreAction extends BaseAction {

	function BackupRestoreAction() {
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

		if (!empty($_FILES['backup'])) {
			$filename = $_FILES["backup"]['tmp_name'];
			$originalFileName = $_FILES["backup"]['name'];
		}
		else if (!empty($_POST['filename'])) {
			$filename = 'WEB-INF/../backups/' . $_POST['filename'];
			$originalFileName = $filename;
		}
		else {
			Common::doLog('failure', 'filename: ' . $_POST['filename']);
			return $mapping->findForwardConfig('failure');
		}
		
		if ($backupPeer->restoreBackup($filename, $originalFileName)) {
			Common::doLog('success', 'filename: ' . $filename);
			return $mapping->findForwardConfig('success');
		}
		else {
			Common::doLog('failure', 'filename: ' . $filename);
			return $mapping->findForwardConfig('failure');
		}
	}

}

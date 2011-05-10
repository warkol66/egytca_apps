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

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Backup";
		$smarty->assign("module",$module);

		$backupPeer = new BackupPeer();

		if (!empty($_FILES['backup'])) {
			$filename = $_FILES["backup"]['tmp_name'];
			$originalFileName = $_FILES["backup"]['name'];
		} else if (!empty($_POST['filename'])) {
			$filename = 'WEB-INF/../backups/' . $_POST['filename'];
			$originalFileName = $filename;
		} else {
			Common::doLog('failure',$filename);
			return $mapping->findForwardConfig('failure');
		}
		
		if ($backupPeer->restoreBackup($filename, $originalFileName)) {
			Common::doLog('success',$filename);
			return $mapping->findForwardConfig('success');
		} else {
			Common::doLog('failure',$filename);
			return $mapping->findForwardConfig('failure');
		}
	}

}

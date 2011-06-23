<?php
/**
 * BackupDeleteAction
 *
 * @package backup
 */

require_once("BackupPeer.php");

class BackupDoDeleteAction extends BaseAction {

	function BackupDoDeleteAction() {
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

		if ($backupPeer->deleteBackup($_POST['filename'])) {
			Common::doLog('success');
			return $mapping->findForwardConfig('success');
		}
		else {
			Common::doLog('failure');
			return $mapping->findForwardConfig('failure');
		}
	}

}

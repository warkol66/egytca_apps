<?php
/**
 * BackupDownloadAction
 *
 * @package backup
 */

class BackupSendByEmailAction extends BaseAction {

	function BackupSendByEmailAction() {
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

		$systemConfig = Common::getConfiguration('system');

		$filename = null;
		$email = null;
		$complete = null;

		if (!empty($_POST['filename']))
			$filename = $_POST['filename'];

		if (!empty($_POST['email']))
			$email = $_POST['email'];

		if (!empty($_POST['complete']))
			$complete = $_POST['complete'];

		require_once("BackupPeer.php");
		$backupPeer = new BackupPeer();

		if($backupPeer->sendBackupToEmail($email, $filename, $complete)) {
			Common::doLog('success','system');
			if (empty($filename))
				die; //Estamos ejecutando por cron.
			return $mapping->findForwardConfig('success');
		}
		else {
			Common::doLog('failure','system');
			if (empty($filename))
				die; //Estamos ejecutando por cron.
			return $mapping->findForwardConfig('failure');
		}

	}

}

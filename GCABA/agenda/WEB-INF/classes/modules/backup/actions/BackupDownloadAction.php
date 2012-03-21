<?php
/**
 * BackupDownloadAction
 *
 * @package backup
 */

class BackupDownloadAction extends BaseAction {

	function BackupDownloadAction() {
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

		if ($_GET['filename']) {

			$filename = $_GET['filename'];
			$content = $backupPeer->getBackupContents($filename);

			if ($content == false)
				return $mapping->findForwardConfig('failure');

			header("Content-type: text/x-sql; charset=UTF-8");
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			echo $content;

		}
		die;
	}
}

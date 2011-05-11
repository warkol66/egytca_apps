<?php
/**
 * BackupDownloadAction
 *
 * @package backup
 */

require_once("BackupPeer.php");

class BackupDownloadAction extends BaseAction {

	function BackupDownloadAction() {
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

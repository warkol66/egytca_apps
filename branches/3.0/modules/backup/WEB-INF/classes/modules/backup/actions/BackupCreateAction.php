<?php
/**
 * BackupCreateAction
 *
 * @package backup
 */

class BackupCreateAction extends BaseAction {

	function BackupCreateAction() {
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
		
		$options = $_GET['options'];
		$content = $backupPeer->createBackup($options);
		if (!$content) {
			Common::doLog('failure','Error creating backup');
			return $mapping->findForwardConfig('failure');
		}
		
		$filename = $backupPeer->getFileName();

		Common::doLog('success','Backup created: ' . $filename);
		
		if ($options['toFile']) {
			header("Content-type: application/zip");
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			echo $content;
			die;
		}
		return $mapping->findForwardConfig('success');
	}
}

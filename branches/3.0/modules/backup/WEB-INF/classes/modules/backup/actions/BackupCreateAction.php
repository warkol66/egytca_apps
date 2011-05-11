<?php
/**
 * BackupCreateAction
 *
 * @package backup
 */

require_once("BackupPeer.php");

class BackupCreateAction extends BaseAction {

	function BackupCreateAction() {
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
		
		$options = $_GET['options'];
		$content = $backupPeer->createBackup($options);
		if (!$content) {
			Common::doLog('failure');
			return $mapping->findForwardConfig('failure');
		}
		
		Common::doLog('success');
		
		if ($options['toFile']) {
			$filename = $backupPeer->getFileName();

			header("Content-type: application/zip");
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			echo $content;
	
			die;
		}
		return $mapping->findForwardConfig('success');
	}
}

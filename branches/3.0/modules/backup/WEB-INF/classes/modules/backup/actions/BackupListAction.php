<?php
/** 
 * BackupListAction
 *
 * @package backup 
 */

require_once("BackupPeer.php");

class BackupListAction extends BaseAction {

	function BackupListAction() {
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
 		$filenames = $backupPeer->getBackupList();	
		
 		$smarty->assign('message',$_GET['message']);
		$smarty->assign('filenames',$filenames);

		return $mapping->findForwardConfig('success');
	}

}

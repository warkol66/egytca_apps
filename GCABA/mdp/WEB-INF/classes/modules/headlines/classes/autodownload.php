<?php

/**
 * Script used by AutoDownloader to download attachments via QueueManager
 */

/**
 * @return int 0: success, !=0 error
 */
$download = function($data) {
	
	$appDir = realpath(__DIR__.'/../../../../..');
	$downloadCmd = 'php Main.php do=headlinesAttachmentDownloadX format=json id='.$data['id'];
	$output = shell_exec("cd $appDir && $downloadCmd");
	
	$res = json_decode($output, true);
	if ($res['error'])
		throw new Exception($res['error']['message']);
	else
		return 0;
};

return $download;

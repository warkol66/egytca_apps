<?php

set_error_handler(function($errno, $errstr, $errfile, $errline , $errcontext) {
	
	// DELETEME
	if ($errno == E_NOTICE)
		return;
	
	$smarty = new SmartyML('en');
	$smarty->left_delimiter = '|-';
	$smarty->right_delimiter = '-|';
	
	$smarty->assign('type', errorTypeString($errno));
	$smarty->assign('text', $errstr);
	$smarty->assign('file', $errfile);
	$smarty->assign('line', $errline);
	
	$smarty->display('WEB-INF/classes/includes/ErrorHandling/ErrorReport.tpl');
	
}, E_ALL - E_STRICT);

set_exception_handler(function($exception) {
	
	$smarty = new SmartyML('en');
	$smarty->left_delimiter = '|-';
	$smarty->right_delimiter = '-|';
	
	$smarty->assign('type', $exception->getCode());
	$smarty->assign('text', $exception->getMessage());
	$smarty->assign('file', $exception->getFile());
	$smarty->assign('line', $exception->getLine());
	$smarty->assign('trace', $exception->getTraceAsString());
	
	$smarty->display('WEB-INF/classes/includes/ErrorHandling/ExceptionReport.tpl');
});


function errorTypeString($type) {
	switch($type)
		{
		case E_ERROR: // 1 //
			return 'E_ERROR';
		case E_WARNING: // 2 //
			return 'E_WARNING';
		case E_PARSE: // 4 //
			return 'E_PARSE';
		case E_NOTICE: // 8 //
			return 'E_NOTICE';
		case E_CORE_ERROR: // 16 //
			return 'E_CORE_ERROR';
		case E_CORE_WARNING: // 32 //
			return 'E_CORE_WARNING';
		case E_CORE_ERROR: // 64 //
			return 'E_COMPILE_ERROR';
		case E_CORE_WARNING: // 128 //
			return 'E_COMPILE_WARNING';
		case E_USER_ERROR: // 256 //
			return 'E_USER_ERROR';
		case E_USER_WARNING: // 512 //
			return 'E_USER_WARNING';
		case E_USER_NOTICE: // 1024 //
			return 'E_USER_NOTICE';
		case E_STRICT: // 2048 //
			return 'E_STRICT';
		case E_RECOVERABLE_ERROR: // 4096 //
			return 'E_RECOVERABLE_ERROR';
		case E_DEPRECATED: // 8192 //
			return 'E_DEPRECATED';
		case E_USER_DEPRECATED: // 16384 //
			return 'E_USER_DEPRECATED';
		}
	return $type;
}

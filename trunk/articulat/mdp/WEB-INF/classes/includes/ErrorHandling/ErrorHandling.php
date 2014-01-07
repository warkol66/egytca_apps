<?php

$wantedErrors = E_ALL -E_STRICT -E_WARNING -E_NOTICE -E_DEPRECATED;

function errortype($errno) {
	
	$errortype = array (
		E_ERROR				=> 'E_ERROR',
		E_WARNING			=> 'E_WARNING',
		E_PARSE				=> 'E_PARSE',
		E_NOTICE			=> 'E_NOTICE',
		E_CORE_ERROR		=> 'E_CORE_ERROR',
		E_CORE_WARNING		=> 'E_CORE_WARNING',
		E_COMPILE_ERROR		=> 'E_COMPILE_ERROR',
		E_COMPILE_WARNING	=> 'E_COMPILE_WARNING',
		E_USER_ERROR		=> 'E_USER_ERROR',
		E_USER_WARNING		=> 'E_USER_WARNING',
		E_USER_NOTICE		=> 'E_USER_NOTICE',
		E_STRICT			=> 'E_STRICT'
	);

	if ((version_compare(PHP_VERSION, '5.2.0')) > 0) {
		$errortype5_2 = array (
			E_RECOVERABLE_ERROR  => 'E_RECOVERABLE_ERROR'
		);
		$errortype = $errortype + $errortype5_2 ;
	}

	if ((version_compare(PHP_VERSION, '5.3.0')) > 0) {
		$errortype5_3 = array (
			E_DEPRECATED     => 'E_DEPRECATED',
			E_USER_DEPRECATED => 'E_USER_DEPRECATED'
		);
		$errortype = $errortype + $errortype5_3 ;
	}
	
	return $errortype[$errno];
}

function sendErrorMail($body) {
	
	require_once('EmailManagement.php');
	$manager = new EmailManagement();
	$user = Common::getLoggedUser();
	$userInfo = is_object($user) ? $user->getUsername() : 'Visitor';
	global $system;
	$subject = 'SITIO: '.$system['config']['system']['parameters']['siteShortName'].' / Error generado por '.$userInfo;
	$email = explode(',', $system['config']['system']['parameters']['debugMail']);
	$mailFrom = $system['config']['system']['parameters']['fromEmail'];
	
	$message = $manager->createHTMLMessage($subject, $body);
	$result = $manager->sendMessage($email, $mailFrom, $message);
	return $result;
}

function createErrorHtmlReport($errtype, $errstr, $errfile, $errline , $errcontext) {
	
	$smarty = new SmartyML('en');
	$smarty->addTemplateDir(__DIR__);
	
	$datetime = date("Y-m-d H:i:s (T)");
	
	$smarty->assign('type', class_exists($errtype) ? $errtype : errortype($errtype));
	$smarty->assign('text', $errstr);
	$smarty->assign('file', $errfile);
	$smarty->assign('line', $errline);
	$smarty->assign('context', $errcontext);
	$smarty->assign('datetime', $datetime);
	
	return $smarty->fetch('ErrorReport.tpl');
}

function handleError($errtype, $errstr, $errfile, $errline , $errcontext) {
	
	$errorHtml = createErrorHtmlReport($errtype, $errstr, $errfile, $errline , $errcontext);
	
	$result = sendErrorMail($errorHtml);
//	if (!$result)
//		echo "<p>mail error</p>";
	
	$smarty = new SmartyML('en');
	$smarty->addTemplateDir(__DIR__);
	
	$showError = true; // environment == development
	$centerHtml = $showError ? $errorHtml : $smarty->fetch('ErrorMessage.tpl');
	
	$smarty->assign('centerHTML', $centerHtml);
	$smarty->display('Template.tpl');
	
	die;
}

set_error_handler(function($errno, $errstr, $errfile, $errline , $errcontext) {
	
	$wantedKeys = array(
		'_GET', '_POST', '_COOKIE', '_FILES', '_REQUEST',
		'_ENV', '_SERVER', '_SESSION',
		'propelVersion', 'osType', 'system'
	);
	
	$sanitizedContext = array();
	foreach ($wantedKeys as $wantedKey) {
		$sanitizedContext[$wantedKey] = $errcontext[$wantedKey];
	}
	
	return handleError($errno, $errstr, $errfile, $errline, $sanitizedContext);
	
}, $wantedErrors);

set_exception_handler(function($exception) {
	
	$context = $exception->getTraceAsString();
	
	return handleError(get_class($exception), $exception->getMessage(),
		$exception->getFile(), $exception->getLine(), $context);
});

register_shutdown_function(function() {
	$error = error_get_last();
	if (!is_null($error) && $error['type'] === E_ERROR) {
		handleError($error['type'], $error['message'], $error['file'], $error['line'], null);
	}
});

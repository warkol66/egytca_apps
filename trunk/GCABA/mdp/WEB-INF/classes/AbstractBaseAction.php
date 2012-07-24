<?php
/*
* $Header: AbstractBaseAction.php
* $Revision:
* $Date: 22.March.2004
*
* ====================================================================
*
* License:	GNU General Public License
*
* Copyright (c) 2002, 2003 John C.Wildenauer.  All rights reserved.
* Note: Original work copyright to respective authors
*
* This file is part of php.MVC.
*
* php.MVC is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version. 
* 
* php.MVC is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details. 
* 
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, 
* USA.
*/

include_once("includes/common.inc.php");


/**
* AbstractBaseAction.php handling.<br>
*
* @author John C Wildenauer
* @version
* @public
*/
class AbstractBaseAction extends Action {

	// ----- Instance Variables --------------------------------------------- //

	// Logging
	var $log				= NULL;

	// ActionErrors class used to save form processing errors
	var $actionErrors	= NULL;

	// PropertyMessageResources class handles message string resources
	var $pmr				= NULL;

	// Users locale
	var $locale			= NULL;		// no user locale supplied

	// database connection
	var $dbConn			= NULL;		


	// ----- Constructor ---------------------------------------------------- //

	function AbstractBaseAction() {
		
		//$this->log	= new Log();	// Class Log is depreciated. Use PhpMVC_Log
		$this->log	= new PhpMVC_Log();
		$this->log->setLog('isDebugEnabled'	, False);
		$this->log->setLog('isTraceEnabled'	, False);

		// Setup a database connection, if required
		;

		// New ActionErrors class (actually extends ActionMessages)
		$this->actionErrors =& new ActionErrors();

		// Setup the message string processing (MessageResources) class
		// Ref: PropertyMessageResourcesTestCase.php for more usage examples

		// Common setup variables
		$config = 'MyAppResources'; // base name of the "MyAppResources.properties" file
		$returnNull = False;	// return something like "???message.hello_world???" if we
									// cannot find a message match in any of the properties files.
		$defaultLocale =& new Locale(); // default appServer Locale
		$factory = NULL;		// MessageResources factory classes, skip for now
		$pmr =& new PropertyMessageResources($factory, $config, $returnNull);
		$pmr->setDefaultLocale($defaultLocale);
		$this->pmr = $pmr;

	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>null</code> if the response has
	* already been completed.
	*
	* @param mapping ActionConfig, The ActionConfig (mapping) used to select 
	*   this instance
	* @param form ActionForm, The optional ActionForm bean for this request (if any)
	* @param request HttpServletRequest, The HTTP request we are processing
	* @param response HttpServletResponse, The HTTP response we are creating
	*
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {
		; // Implement this method in your concrete Action classes
		
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		$GLOBALS['_NG_LANGUAGE_'] =& $smarty->language;
		if (!empty($GLOBALS['_NG_LANGUAGE_']))
			$GLOBALS['_NG_LANGUAGE_']->setCurrentLanguage("eng");
			
		header("Content-type: text/html; charset=UTF-8");

		$this->template = new SmartyOutputFilter();
		$smarty->register_outputfilter(array($this->template,"smarty_add_template"));

		if (!empty($GLOBALS['_NG_LANGUAGE_']))
			$smarty->register_outputfilter("smarty_outputfilter_i18n");
	}

}

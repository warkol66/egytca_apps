<?php

require_once("$appServerRootDir/WEB-INF/classes/phpmvc/utils/ActionDispatcher.php");
/*
* SmartyActionDispatcher.php
* Revision: 1.0
* Date: 10.July.2003
*
* ====================================================================
*
* License:	GNU Lesser General Public License (LGPL)
*
* Copyright (c) 2003 John C.Wildenauer.  All rights reserved.
*
* This file is part of the php.MVC Web applications framework
*
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU Lesser General Public
* License as published by the Free Software Foundation; either
* version 2.1 of the License, or (at your option) any later version.

* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
* Lesser General Public License for more details.

* You should have received a copy of the GNU Lesser General Public
* License along with this library; if not, write to the Free Software
* Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


/**
* Application specific implementation of <code>ActionDispatcher</code>
*
* @author John C Wildenauer
* @version 1.0
* @public
*/
class SmartyActionDispatcher extends ActionDispatcher {


	// ----- Constructors --------------------------------------------------- //

	/**
	* Construct a new instance of this class, configured according to the
	* specified parameters.
	*
	* @param string	Uri or Definition name to forward (Eg: '/index.php')
	* @param Wrapper	The Wrapper associated with the resource that will
	*  be forwarded to or included (required).
	* @param string	The revised servlet path to this resource (if any).
	* @param string	The revised extra path information to this resource if any).
	* @param string	Query string parameters included with this request (if any).
	* @param string	Servlet name (if a named dispatcher was created) else 
	* <code>NULL</code>
	*
	* @public
	* @returns void
	*/
	function SmartyActionDispatcher($uri='', $wrapper='', $servletPath='',
 											$pathInfo='', $queryString='', $name='') {


		// Setup the parent constructor first
		parent::ActionDispatcher($uri='', $wrapper='', $servletPath='',
 											$pathInfo='', $queryString='', $name='');

		$this->log->setLog('isDebugEnabled'	, False);
		$this->log->setLog('isInfoEnabled'	, False);
		$this->log->setLog('isTraceEnabled'	, False);

	}


// ----- Private Methods ------------------------------------------------ //

	/**
	* Build the application specific implementation response
	*
	* <p>Operation:<br>
	*	a) Retrieve a reference to the Smarty template instance.<br>
	*	b) Capture the output of the Smarty->display() method AND save it
	*     to the <code>$response</code> object for later transmission.
	* </p>
	*
	* @param request ServletRequest, The servlet request we are processing
	* @param response ServletResponse, The servlet response we are creating
	*
	* @author	John Wildenauer	
	* @private
	* @returns void
	* @version	1.0
	*/
	function serviceResponse(&$request, &$response) {

		$debug = $this->log->getLog('isDebugEnabled');
		$trace = $this->log->getLog('isTraceEnabled');

		if($trace)
			$this->log->trace('Start: OOHFormsActionDispatcher->serviceResponse(..)['.__LINE__.']');


		// Access the ActionServer reference
		$as =& $this->getActionServer();
		
		// Access the Smarty PlugIn instance
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $as->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		// The resource (page) to display
		$requestURI = $this->uri;


		// Retrieve the requested page, to the $pageBuff
		$pageBuff = '';
		ob_start();

			// Smarty way: Capture the Smarty output
			$smarty->display($requestURI);
			$pageBuff = ob_get_contents();

		ob_end_clean();


		// Attach the output to the response object for later transmission
		$response->setResponseBuffer($pageBuff);

	}

}

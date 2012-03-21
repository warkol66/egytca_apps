<?php
/*
* DemoPageForm.php
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


include_once 'ActionForm.php';


/**
* DemoPageForm is an ActionForm that demonstrates the use of the Smarty
* compiling PHP template engine within php.MVC.
*
* @author John C Wildenauer
* @version 1.0
* @public
*/
class BaseForm extends ActionForm {

  var $STATUSLOGIN = '';
	var $LOGIN = '';
  var $SESION = '';
  var $BROWSER = '';

  function setStatusLogin($STATUSLOGIN) {
     $this->STATUSLOGIN = $STATUSLOGIN;
  }
  function getStatusLogin() {
     return $this->STATUSLOGIN;
  }
  
  function setLogin($LOGIN) {
     $this->LOGIN = $LOGIN;
  }
  function getLogin() {
     return $this->LOGIN;
  }
  
  function setSesion($SESION) {
     $this->SESION = $SESION;
  }
  function getSesion() {
     return $this->SESION;
  }
  
  function setBrowser($BROWSER) {
     $this->BROWSER = $BROWSER;
  }
  function getBrowser() {
     return $this->BROWSER;
  }


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Reset all properties to their default values.
	*
	* @param mapping ActionMapping, The mapping used to select this instance
	* @param request HttpServletRequest, The servlet request we are processing
	*/
	function reset($mapping, $request) {

		;

	}


	/**
	* Validate the properties that have been SET FROM this HTTP request,
	* AND return an <code>ActionErrors</code> object that encapsulates any
	* validation errors that have been found. If no errors are found, return
	* <code>NULL</code> or an <code>ActionErrors</code> object with no
	* recorded error messages.
	*
	* @param mapping ActionMapping, The mapping used to select this instance
	* @param request HttpServletRequest, The servlet request we are processing
	* @returns ActionErrors
	*/
	function validate(&$mapping, &$request) {

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
//		$smarty->left_delimiter  = "|-";
//    $smarty->right_delimiter = "-|";


		//////////
		// SET some Smarty template variables

    $smarty->assign("STATUSLOGIN",$this->STATUSLOGIN);

    $smarty->assign("LOGIN",$this->LOGIN);

    $smarty->assign("SESION",$this->SESION);

    $smarty->assign('BROWSER',$this->BROWSER);


		//////////
		// Next stop is the DemoPageAction class
		// (Return NULL AND continue processing)
		return;

	}

}
?>

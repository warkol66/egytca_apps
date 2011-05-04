<?php
/*
* MenuGuardarAction.php
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


include_once 'Action.php';
include_once 'BaseAction.php';
include_once("includes/common.inc.php");
include_once("includes/TipoUsuario.class.php");
include_once("includes/Permisos.class.php");
include_once("includes/DBConnection.inc.php");


/**
* Implementation of <strong>Action</strong> that demonstrates the use of the Smarty
* compiling PHP template engine within php.MVC.
*
* @author John C Wildenauer
* @version 1.0
* @public
*/
class PermisosGuardarAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PermisosGuardarAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, AND create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing WHERE AND how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);
		global $PHP_SELF;
		global $db;
		//////////
		// Call our business logic FROM here

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$smarty->left_delimiter  = "|-";
	    $smarty->right_delimiter = "-|";
		$db = new DBConnection();
		$db->connect();
		$permisosObject = new Permisos();
		if (!empty($_POST['tipo_usuario']))
		{
			foreach ($_POST['tipo_usuario'] as $perm)
			{
				$permiso+= $perm;
			}
		}
		$permisosObject->guardar($_POST['action'],$permiso);
		$smarty->assign("TODOS",$todos);
		$smarty->assign("ACTION",$_GET['action']);
		$smarty->assign("PHP_SELF",$PHP_SELF);
		$smarty->assign("LOGIN",$_SESSION['usuario']);
		$smarty->assign("SESION", $_SESSION);
		$smarty->assign('BROWSER',getBrowser());
		//////////
		// Forward control to the specified success URI
		return $mapping->findForwardConfig('success');

	}

}
?>

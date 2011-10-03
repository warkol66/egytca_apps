<?php

/**
* DocumentsEditAction
*
* Action que permite ver los datos correspondientes de un documento que pueden modificarse
*
* @package documents
*/

class DocumentsEditAction extends BaseAction {

	function DocumentsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Documents";
		$smarty->assign("module",$module);

		$documentPeer= new DocumentPeer();
		$categoryPeer = new CategoryPeer();

		////////////
		//obtengo las categorias que el usuario puede acceder
		$user = Common::getAdminLogged();
		$smarty->assign('user',$user);
		$categories = $categoryPeer->getAllParentsByUserAndModule($user,$module);
		$smarty->assign("categories",$categories);

		$smarty->assign("documentsUpload", true); //en el template se realizan subidas de documentos
		$documentTypes = DocumentPeer::getDocumentsTypesConfig();
		$smarty->assign("documentTypes",$documentTypes);

		$maxUploadSize =  Common::maxUploadSize();
		$smarty->assign("maxUploadSize",$maxUploadSize);

		$moduleConfig = Common::getModuleConfiguration($module);
		if ($moduleConfig["usePasswords"]["value"] == "YES")
			$usePasswords = true;
		$smarty->assign("usePasswords",$usePasswords);

		$generalParentCategories = $user->getDocumentsGeneralParentCategories();
		$smarty->assign('generalParentCategories',$generalParentCategories);

		$parentCategories = $user->getDocumentsParentCategories();
		$smarty->assign('parentCategories',$parentCategories);

		//caso de edicion de un documento
		if (isset($_POST['id'])) {

			$msg = $request->getParameter("message");
			if(empty($msg))
				$msg = "noError";

			$smarty->assign("message",$msg);

			// obtengo el documento seleccionado
			$id = $_POST["id"];
			$document = DocumentPeer::get($id);

			//password enviado desde el listado
			$password = $_POST['password'];

			//validacion de password
			if (!$document->checkPasswordValidation($password))
				return $mapping->findForwardConfig('failure-edit');

			$smarty->assign("action","edit");

			$smarty->assign("document",$document);
			$smarty->assign("entity",$_POST['entity']);
			$smarty->assign("entityId",$_POST['entityId']);
			return $mapping->findForwardConfig('success-edit');

		}
		else
			$smarty->assign("action","create");

		//caso de creacion de nuevo documento
		$categoryPeer = new CategoryPeer();

		$smarty->assign("docscategory",$categoryId);
		$smarty->assign("date",date("d/m/y"));

		return $mapping->findForwardConfig('success-upload');

	}

}

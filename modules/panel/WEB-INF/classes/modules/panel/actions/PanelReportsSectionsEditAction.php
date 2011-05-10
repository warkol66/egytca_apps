<?php

class PanelReportsSectionsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelReportsSectionsEditAction() {
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

		$module = "Panel";
		$smarty->assign("module",$module);
		
		//obtengo las categorias que el usuario puede acceder	
		$loginUser = Common::getAdminLogged();
		$smarty->assign('loginUser',$loginUser);

		$reportSectionPeer = new ReportSectionPeer();
		$sectionTypes = $reportSectionPeer->getTypesTranslated();
		$smarty->assign("sectionTypes",$sectionTypes);

		if ( !empty($_GET["id"]) ) {
			$section = ReportSectionPeer::get($_GET["id"]);			
			$sections =  ReportSectionPeer::getAllPossibleParentsByType($section->getType(), $section->getVersionId());
			$type = $section->getType();
			$objectType = ReportSectionPeer::getObjectTypeBySectionType($type);
			$objects = ReportSectionPeer::getObjectsBySectionType($type);
			$smarty->assign('objectType',$objectType);
			$smarty->assign('objects',$objects);
			
			$object = $section->getObject();
			if (!empty($object)) {
				$smarty->assign(Common::strtocamel($objectType, false), $object);              //Permite renderizar el formulario
				$this->prepareEmbeddedForm($objectType, $smarty);                              //de la entidad para el lightBox.
			}

			$documentsUpload = ConfigModule::get("reportSections","useDocuments");             //en el template se realizan 
			$smarty->assign("documentsUpload", $documentsUpload);                              //subidas de documentos
	
			$maxUploadSize =  Common::maxUploadSize();
			$smarty->assign("maxUploadSize",$maxUploadSize);
			
			$documentTypes = DocumentPeer::getDocumentsTypesConfig();
			$smarty->assign("documentTypes",$documentTypes);
	
			// Busco todos los documentos asociados a la seccion
			$documents = $section->getDocuments();
			$smarty->assign("documents",$documents);
			
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un position nuevo
			$section = new ReportSection();
			$sections =  ReportSectionPeer::getAllPossibleParents();
			$smarty->assign("action","create");
		}

		$smarty->assign("section",$section);
		$smarty->assign("sections",$sections);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}


<?php

class ServicesMultilangTextsDoEditBulkAction extends BaseAction {

	function ServicesMultilangTextsDoEditBulksAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Services";
		$smarty->assign('module',$module);
		$section = "Multilang";
		$smarty->assign('section',$section);

		$appLanguages = MultilangLanguagePeer::getAll();
		$appLanguagesCount = count($appLanguages);

		$traductions = array();
		$i = 0;
		$j = 0;
		$traduction = array();
		foreach ($_POST["text"] as $item) {
			//los primeros $appLanguagesCount son del div oculto
			if ($i >= $appLanguagesCount) {
				foreach ($item as $languageCode => $text) {
					$traduction[$languageCode] = $text;
				}
				$j++;
				//Cuando complete todas las traducciones de un texto, debo guardar el conjunto en $traductions
				if ($j == $appLanguagesCount) {
					$traductions[] = $traduction;
					$traduction = array();
					$j = 0;
				}
			}
			$i++;
		}

		foreach ($traductions as $traduction) {
			$i=0;
			foreach ($traduction as $languageCode => $text) {
				if ($i==0)
					$id = MultilangTextPeer::create($_POST["moduleName"],$languageCode,$text);
				else
							MultilangTextPeer::createWithId($id,$_POST["moduleName"],$languageCode,$text);
				$i++;
			}
		}

		/*
		if ( $_POST["action"] == "edit" ) {
			//estoy editando un text existente

			foreach ($_POST["text"] as $languageId => $text)
				MultilangTextPeer::update($_POST["id"],$_POST["moduleName"],$languageId,$text);

		} else {
			//estoy creando un nuevo text
			$i=0;
			foreach ($_POST["text"] as $languageId => $text) {
				if ($i==0)
					$id = MultilangTextPeer::create($_POST["moduleName"],$languageId,$text);
				else
								MultilangTextPeer::createWithId($id,$_POST["moduleName"],$languageId,$text);
				$i++;
			}
		}
		*/

		header("Location: Main.php?do=servicesMultilangTextsList&moduleName=".$_POST["moduleName"]."&page=".$_POST["currentPage"]);
		exit;

		return $mapping->findForwardConfig('success');
	}

}

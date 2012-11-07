<?php
/**
* ContentListAction
* Listado de los distintos contenidos y secciones.
* @package  content
*/

class ContentListAction extends BaseAction {

	function ContentListAction() {
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

		$smarty->assign("message",$_GET['message']);
		$module = "Content";
		$smarty->assign("module",$module);


		$parentId = 0;
        $defaultLanguage=ContentActiveLanguageQuery::getDefaultLanguage();

		if (!isset($_GET['sectionId']) || (isset($_GET['sectionId']) && ($_GET['sectionId'] == 0 ))) {
            $root=ContentQuery::create()->findRoot();
            if(!$root){
                $root=new Content();
                $root->setType(1);
                $root->makeRoot();
                $root->save();
            }
            $parentId=$root->getId();
            $elements=$root->getChildren();

		}
		else {
            $parent=ContentQuery::create()->findPk($_GET['sectionId']);
            if(!$parent){
                $parent=ContentQuery::create()->findRoot();
            }
			//estoy en una rama del arbol
			$elements = $parent->getChildren();
			$parentId = $parent->getId();

			//obtengo la descripcion de la seccion y su titulo
            $navigationChain=$parent->getAncestors();
            if($navigationChain instanceof PropelCollection) $navigationChain=$navigationChain->getArrayCopy();
            array_push($navigationChain,$parent);
			$smarty->assign("navigationChain",$navigationChain);

            $parent->setLocale($defaultLanguage->getLanguagecode());
			$smarty->assign("sectionDescription",$parent->getContentValue());
			$smarty->assign("sectionTitle",$parent->getTitle());
		}

		$smarty->assign("parentId",$parentId); //asignamos el id del padre
		$smarty->assign("elements",$elements);
        $smarty->assign("defaultLanguage",$defaultLanguage);

		return $mapping->findForwardConfig('success');

	}

}

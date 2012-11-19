<?php
/**
 * ContentListAction
 * Listado de los distintos contenidos y secciones.
 * @package  content
 */

class ContentLanguageDoEditAction extends BaseAction
{

    function ContentLanguagesDoEdittAction()
    {
        ;
    }

    function execute($mapping, $form, &$request, &$response)
    {

        BaseAction::execute($mapping, $form, $request, $response);

        //////////
        // Access the Smarty PlugIn instance
        // Note the reference "=&"
        $plugInKey = 'SMARTY_PLUGIN';
        $smarty =& $this->actionServer->getPlugIn($plugInKey);
        if ($smarty == NULL) {
            echo 'No PlugIn found matching key: ' . $plugInKey . "<br>\n";
        }
        $this->template->template = 'TemplateJQuery.tpl';

        $smarty->assign("message", $_GET['message']);
        $module = "Content";
        $smarty->assign("module", $module);

        $smarty->assign('defaultLanguage',ContentActiveLanguageQuery::getDefaultLanguage());

        if (isset($_REQUEST["id"]) && $_REQUEST["id"]!="") {

            $id = $_REQUEST["id"];

            $idioma = ContentActiveLanguageQuery::create()->findPk($id);

            $idioma->fromArray($_POST["params"],BasePeer::TYPE_FIELDNAME);
            $idioma->save();
            return $mapping->findForwardConfig('success');
        }
        else{
            $idioma=new ContentActiveLanguage();
            $idioma->fromArray($_POST["params"],BasePeer::TYPE_FIELDNAME);
            $idioma->save();
            return $mapping->findForwardConfig('success');
        }

    }

}

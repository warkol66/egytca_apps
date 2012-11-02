<?php
/**
 * ContentListAction
 * Listado de los distintos contenidos y secciones.
 * @package  content
 */

class ContentLanguageEditAction extends BaseAction
{

    function ContentLanguageEditAction()
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

        $smarty->assign("message", $_GET['message']);
        $module = "Content";
        $smarty->assign("module", $module);


        if (isset($_REQUEST["id"])) {

            $id = $_REQUEST["id"];

            $idioma = ContentActiveLanguageQuery::create()->findPk($id);
            if ($idioma)
                $smarty->assign("idioma", $idioma);
            else {
                $smarty->assign("notValidId", true);
            }
            $smarty->assign("action", "edit");
        }
        else{
            $idioma=new ContentActiveLanguage();
            $smarty->assign("idioma", $idioma);
            $smarty->assign("action", "create");
        }
        return $mapping->findForwardConfig('success');

    }

}

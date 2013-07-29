<?php
/**
 * ContentEditAction
 * Muestra el formulario para permitir la edición de un contenido
 * @package  content
 */

class ContentEditAction extends BaseAction
{

    function ContentEditAction()
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

        $module = "Content";
        $smarty->assign("module", $module);

        $languages = ContentActiveLanguageQuery::create()->filterByActive(1)->find();
        $smarty->assign('languages', $languages);

        $defaultLanguage = ContentActiveLanguageQuery::getDefaultLanguage();
        $smarty->assign('defaultLanguage', $defaultLanguage);

        $root = ContentQuery::create()->findRoot();

        $iteratorCriteria = ContentQuery::create()->filterByType(1);

        $smarty->assign('root', $root);
        $smarty->assign('iteratorCriteria', $iteratorCriteria);

        // Para el caso de editar.
        if (isset($_GET['id'])) {
            $content = ContentQuery::create()->findPK($_GET['id']);

            if ($content) {
                $smarty->assign("content", $content);
                $smarty->assign("type", $content->getTypeTranslated());

                $smarty->assign("parentId", $content->getParent()->getId());
                $smarty->assign("loadAreaedit", 1);

                $navigationChain = $content->getAncestors();
                $navigationChain = array_reverse($navigationChain);
                $smarty->assign("navigationChain", $content->getAncestors());
            }
            else $smarty->assign("notValidId", 1);
            return $mapping->findForwardConfig('success');
        }

        // En el caso de crear
        $smarty->assign("content", new Content());
        $smarty->assign("type", $_GET['type']);
        $smarty->assign("parentId", $_GET['parentId']);

        $parent = ContentQuery::create()->findPk($_GET['parentId']);
        $navigationChain = $parent->getAncestors();
        array_unshift($navigationChain, $parent);

        $navigationChain = array_reverse($navigationChain);
        $smarty->assign("navigationChain", $navigationChain);


        return $mapping->findForwardConfig('success');
    }

}

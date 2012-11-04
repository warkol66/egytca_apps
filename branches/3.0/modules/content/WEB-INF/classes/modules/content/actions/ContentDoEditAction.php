<?php
/**
 * ContentDoEditAction
 * Guarda los cambios realizados a un contenido
 * @package  content
 */

class ContentDoEditAction extends BaseAction
{

    function ContentDoEditAction()
    {
        ;
    }

    function getForward($forward, $sectionId, $mapping)
    {

        $myRedirectConfig = $mapping->findForwardConfig($forward);
        $myRedirectPath = $myRedirectConfig->getpath();
        $queryData = '&sectionId=' . $sectionId;
        $myRedirectPath .= $queryData;
        $fc = new ForwardConfig($myRedirectPath, True);
        return $fc;

    }

    function addSlasshesToContent()
    {

        $languages = ContentActiveLanguageQuery::create()->filterByActive(1)->find();
        foreach ($languages as $eachLanguage) {
            $languageCode = $eachLanguage->getLanguagecode();
            $_POST['locale'][$languageCode]['title'] = addslashes($_POST['locale'][$languageCode]['title']);
            $_POST['locale'][$languageCode]['titleInMenu'] = addslashes($_POST['locale'][$languageCode]['titleInMenu']);
            $_POST['locale'][$languageCode]['content_value'] = addslashes($_POST['locale'][$languageCode]['content_value']);
        }

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

        $module = "Content";


        if (!get_magic_quotes_gpc() || !get_magic_quotes_runtime())
            $this->addSlasshesToContent();

        // En el caso de la edicion.
        if (isset($_REQUEST["id"]) && $_REQUEST["id"] != "") {
            $content=ContentQuery::create()->findPk($_REQUEST["id"]);

            $params = $_POST["params"];
            $content->fromArray($params, BasePeer::TYPE_FIELDNAME);

            $parentId=$content->getParent()->getId();

            if($content->getType()!=1){
                // Para Contenidos y Links
                if($content->getParent()->getId()!=$_REQUEST["parentId"]){
                    $parent = ContentQuery::create()->findPk($_REQUEST["parentId"]);
                    $content->moveToLastChildOf($parent);
                    $parentId=$parent->getId();
                }
            }

            $languages = ContentActiveLanguageQuery::create()->filterByActive(1)->find();
            foreach ($languages as $eachLanguage) {
                $languageCode = $eachLanguage->getLanguagecode();

                $contentLocale=ContentI18nQuery::create()->filterByLocale($languageCode)->filterById($content->getId())->findOne();
                if(!$contentLocale) $contentLocale=new ContentI18n();
                $contentLocale->setLocale($languageCode);
                $contentLocale->setTitle($_POST['locale'][$languageCode]['title']);
                $contentLocale->setTitleinmenu($_POST['locale'][$languageCode]['titleInMenu']);
                $contentLocale->setContentValue($_POST['locale'][$languageCode]['content_value']);
                $content->addContentI18n($contentLocale);
            }

            $content->save();
            return $this->addParamsToForwards(array("sectionId"=>$parentId),$mapping,"success");

        } else {
            // El caso de estar creando.
            $parentId = $_REQUEST["parentId"];
            $parent = ContentQuery::create()->findPk($parentId);

            $params = $_POST["params"];

            $content = new Content();
            $content->fromArray($params, BasePeer::TYPE_FIELDNAME);

            $content->insertAsLastChildOf($parent);


            $languages = ContentActiveLanguageQuery::create()->filterByActive(1)->find();
            foreach ($languages as $eachLanguage) {
                $languageCode = $eachLanguage->getLanguagecode();

                $contentLocale=new ContentI18n();
                $contentLocale->setLocale($languageCode);
                $contentLocale->setTitle($_POST['locale'][$languageCode]['title']);
                $contentLocale->setTitleinmenu($_POST['locale'][$languageCode]['titleInMenu']);
                $contentLocale->setContentValue($_POST['locale'][$languageCode]['content_value']);
                $content->addContentI18n($contentLocale);
            }

            $content->save();

            return $this->addParamsToForwards(array("sectionId"=>$parentId),$mapping,"success");

        }

    }
}
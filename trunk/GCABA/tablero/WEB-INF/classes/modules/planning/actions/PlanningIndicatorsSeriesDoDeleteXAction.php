<?php
/**
 * IndicatorsSeriesDoDeleteXAction
 *
 * Permite mediante Ajax la eliminacion de una Serie.
 *
 * @package  projects
 */

require_once("BaseAction.php");

class PlanningIndicatorsSeriesDoDeleteXAction extends BaseAction
{

    function PlanningIndicatorsSeriesDoDeleteXAction()
    {

    }

    function execute($mapping, $form, &$request, &$response)
    {

        BaseAction::execute($mapping, $form, $request, $response);

        /**
         * Use a different template
         */
        $this->template->template = "TemplateAjax.tpl";

        //////////
        // Access the Smarty PlugIn instance
        // Note the reference "=&"
        $plugInKey = 'SMARTY_PLUGIN';
        $smarty =& $this->actionServer->getPlugIn($plugInKey);
        if ($smarty == NULL) {
            echo 'No PlugIn found matching key: ' . $plugInKey . "<br>\n";
        }

        $module = "Indicators";


        $serieId = $_POST['id'];

        $smarty->assign("id", $serieId);

        try {
            // Borrando todas Y asociadas a la serie/
            PlanningIndicatorYQuery::create()->filterBySerieid($serieId)->delete();

            PlanningIndicatorSerieQuery::create()->filterById($serieId)->delete();
        } catch (PropelException $exp) {
            if (ConfigModule::get("global", "showPropelExceptions"))
                print_r($exp->getMessage());
            exit;
            return $mapping->findForwardConfig('failure');
        }
        return $mapping->findForwardConfig('success');


    }

}

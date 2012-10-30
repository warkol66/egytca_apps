<?php

require_once("BaseAction.php");

class IndicatorsDoEditAction extends BaseAction
{


    // ----- Constructor ---------------------------------------------------- //

    function IndicatorsDoEditAction()
    {

    }


    // ----- Public Methods ------------------------------------------------- //

    /**
     * Process the specified HTTP request, and create the corresponding HTTP
     * response (or forward to another web component that will create it).
     * Return an <code>ActionForward</code> instance describing where and how
     * control should be forwarded, or <code>NULL</code> if the response has
     * already been completed.
     *
     * @param ActionConfig        The ActionConfig (mapping) used to select this instance
     * @param ActionForm            The optional ActionForm bean for this request (if any)
     * @param HttpRequestBase    The HTTP request we are processing
     * @param HttpRequestBase    The HTTP response we are creating
     * @public
     * @returns ActionForward
     */
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

        $filters = $_REQUEST["filters"];

        $module = "Indicators";

        if (!empty($_POST["id"])) {


            $indicator = IndicatorQuery::create()->findPk($_POST["id"]);
            $indicator->fromArray($_POST["indicatorData"], BasePeer::TYPE_FIELDNAME);
            $params = array("contractId" => $indicator->getContractid());
            $indicator->save();
            return $this->addParamsAndFiltersToForwards($params, $filters, $mapping, 'success');

        } else {
            $params = array("contractId" => $_REQUEST["contractId"]);
            $indicator = new Indicator();

            $indicator->fromArray($_POST["indicatorData"], BasePeer::TYPE_FIELDNAME);
            $indicator->setType(IndicatorPeer::LINE);
            $indicator->setGraphtype(0);
            $indicator->setLabelx("Fecha");
            $indicator->setLabely("Inversión");
            $indicator->setDecimals(2);
            $indicator->setContractid($_REQUEST["contractId"]);
            if (!$indicator->save()) {
                $smarty->assign("indicator", $indicator);
                $smarty->assign("action", "create");
                $smarty->assign("message", "error");
                return $this->addParamsAndFiltersToForwards($params, $filters, $mapping, 'failure');
            }
            return $this->addParamsAndFiltersToForwards($params, $filters, $mapping, 'success');
        }
    }
}

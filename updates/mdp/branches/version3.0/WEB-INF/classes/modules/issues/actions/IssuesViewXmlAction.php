<?php

require_once("BaseAction.php");

class GraphIssue {
    
    private $name;
    private $values;
    
    function GraphIssue($name, $values) {
        $this->name = $name;
        $this->values = $values;
    }
    
    function getName() {
        return $this->name;
    }
    
    function getValues() {
        return $this->values;
    }

}

class IssuesViewXmlAction extends BaseAction {


    // ----- Constructor ---------------------------------------------------- //

    function IssuesViewXmlAction() {
        ;
    }
    
    
    function makeDates($issues) {
        return array("1","2","3","4","5","6","7","8","9");
    }
    
    function makeSingleGraphIssue($issue, $dates) {
        $array = array();
        foreach ($issue->getAllVersions() as $version) {
            $array = array_merge($array, array($version->getEvolution()));
        }
        return array(new GraphIssue($issue->getName(), $array));
    }
    
    function makeGraphIssues($issues, $dates) {
        $array = array();
        foreach ($issues as $issue) {
            $array = array_merge($array, $this->makeSingleGraphIssue($issue, $dates));
        }
        return $array;
    }


    // ----- Public Methods ------------------------------------------------- //

    /**
    * Process the specified HTTP request, and create the corresponding HTTP
    * response (or forward to another web component that will create it).
    * Return an <code>ActionForward</code> instance describing where and how
    * control should be forwarded, or <code>NULL</code> if the response has
    * already been completed.
    *
    * @param ActionConfig		The ActionConfig (mapping) used to select this instance
    * @param ActionForm			The optional ActionForm bean for this request (if any)
    * @param HttpRequestBase	The HTTP request we are processing
    * @param HttpRequestBase	The HTTP response we are creating
    * @public
    * @returns ActionForward
    */
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

	$module = "Issues";
	$smarty->assign("module",$module);

	$this->template->template = 'TemplateAjax.tpl';
	header ("content-type: text/xml; charset=utf-8");

	//Encabezado BOM para que el flash chart identifique el UTF-8
	echo pack ( "C3" , 0xef, 0xbb, 0xbf );
        

        if (!empty($_REQUEST["type"]) && !empty($_REQUEST["id"])) {
            $criteria = new Criteria();
            $criteria->add("id", $_REQUEST["id"], Criteria::IN);
            
            switch ($_REQUEST["type"]) {
                case "issues":
                    $issues = IssuePeer::doSelect($criteria);
                    break;
                case "category":
                    echo "uninplemented";
                    break;
                case "actor":
                    echo "uninplemented";
                    break;
            }
        }
        $dates = $this->makeDates($issues);
        $graphIssues = $this->makeGraphIssues($issues, $dates);
        
        $smarty->assign("dates", $dates);
        $smarty->assign("graphIssues", $graphIssues);
        
        return $mapping->findForwardConfig('success');
    }
}



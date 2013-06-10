<?php

class IssuesEditBaseAction extends BaseAction {

    function IssuesEditBaseAction() {
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

        $module = "Issues";
        $smarty->assign("module",$module);

        $moduleConfig = Common::getModuleConfiguration($module);
        $smarty->assign("moduleConfig",$moduleConfig);

        $smarty->assign("filters",$_GET["filters"]);
        $smarty->assign("page",$_GET["page"]);
        $smarty->assign("message",$_GET["message"]);

        $issueTable = IssuePeer::getTableMap();
        $smarty->assign("issueTable",$issueTable);

        if (!empty($_GET["id"])) {

            $issue = IssuePeer::get($_GET["id"]);

           if (!is_null($issue)) {

                if (!empty($_GET["version"])) {
                    $issue->toVersion($_GET["version"]);
                }
                
                $actualCategories = $issue->getIssueCategorys();
                $smarty->assign("actualCategories",$actualCategories);
                
                if (!$actualCategories->isEmpty())
                    $excludeCategoriesIds = $issue->getAssignedCategoriesArray($_GET["id"]);

                $criteria = new Criteria();
                $criteria->add(IssueCategoryPeer::ID, $excludeCategoriesIds, Criteria::NOT_IN);
                $categoryCandidates = IssueCategoryPeer::doSelect($criteria);
                $smarty->assign("categoryCandidates",$categoryCandidates);

            }
            else {

                $smarty->assign("message","Not valid issue Id");
                $smarty->assign("url","Main.php?do=issuesList");
                return $mapping->findForwardConfig('failure');
            }

            $smarty->assign("issue",$issue);
        }

        $issueImpactTypes = Common::getTranslatedArray(IssuePeer::getIssueImpactTypes(),'issues');
        $smarty->assign("issueImpactTypes",$issueImpactTypes);
        $issueEvolutionStages = Common::getTranslatedArray(IssuePeer::getIssueEvolutionStages(),'issues');
        $smarty->assign("issueEvolutionStages",$issueEvolutionStages);
        $issueValorationTypes = Common::getTranslatedArray(IssuePeer::getIssueValorationTypes(),'issues');
        $smarty->assign("issueValorationTypes",$issueValorationTypes);

        return $mapping->findForwardConfig('success');
    }

}

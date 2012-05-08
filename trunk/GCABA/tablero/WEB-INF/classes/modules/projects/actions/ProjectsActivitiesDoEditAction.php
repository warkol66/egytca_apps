<?php

class ProjectsActivitiesDoEditAction extends BaseAction {

	function TableroilestonesDoEditAction() {
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

		$module = "Projects";

		if ( $_POST["action"] == "edit" ) {

			if ( ProjectActivityPeer::update($_POST["id"],$_POST["params"]) )

				$logSufix = ', ' . Common::getTranslation('action: edit','common');
				Common::doLog('success', $_POST["params"]["name"] . $logSufix);
      			
				if (isset($_POST['show'])) {
					
					$myRedirectConfig = $mapping->findForwardConfig('success-show');
					$myRedirectPath = $myRedirectConfig->getpath();
					$queryData = '&projectId='.$_POST["projectId"];
					$myRedirectPath .= $queryData;
					$fc = new ForwardConfig($myRedirectPath, True);
					return $fc;
					
				}

			if (!empty($_POST['filters']['fromProjects']))
				return $this->addFiltersToForwards(array('fromProjects'=>$_POST['filters']['fromProjects'], 'projectId'=>$_POST['filters']['projectId']),$mapping,'success');
			return $mapping->findForwardConfig('success');	

		}
		else {

			if ( !ProjectActivityPeer::create($_POST["params"]) ) {
				$activity = new ProjectActivity();
				$activity = Common::setObjectFromParams($activity,$_POST["params"]);
				$smarty->assign("activity",$activity);	
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      }

			if (isset($_POST['show'])) {

				$myRedirectConfig = $mapping->findForwardConfig('success-show');
				$myRedirectPath = $myRedirectConfig->getpath();
				$queryData = '&projectId='.$_POST["projectId"];
				$myRedirectPath .= $queryData;
				$fc = new ForwardConfig($myRedirectPath, True);
				return $fc;

			}
			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["params"]["name"] . $logSufix);
			if (!empty($_POST["fromProjectId"]) && !empty($_POST["button_add_more"])) {
				$params = array ( "fromProjectId" => $_POST["fromProjectId"]);				
				return $this->addParamsToForwards($params,$mapping,'success-more');
			}
			if (!empty($_POST['filters']['fromProjects']))
				return $this->addFiltersToForwards(array('fromProjects'=>$_POST['filters']['fromProjects'], 'projectId'=>$_POST['filters']['projectId']),$mapping,'success');
			return $mapping->findForwardConfig('success');	
		}

	}

}

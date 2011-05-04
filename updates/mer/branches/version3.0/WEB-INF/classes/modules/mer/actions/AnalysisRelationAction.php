<?php

require_once("BaseAction.php");
require_once("mer/Form.php");
require_once("mer/Actor.php");
require_once("mer/FormSection.php");
require_once("mer/Question.php");
require_once("mer/QuestionOption.php");
require_once("mer/CategoryPeer.php");
require_once("mer/Answer.php");
require_once("mer/User.php");
require_once("mer/GraphRelationPeer.php");

class AnalysisRelationAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //


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
		$actor1 = ActorPeer::retrieveByPK($request->getParameter("actor"));

		$smarty->assign('actor1',$actor1);
		if ($request->getParameter("actor2")){
			if ( $request->getParameter("actor2") == "all" ) {
				$actor2 = new Actor();
				$actor2->setName("all");
				$graphs = GraphRelationPeer::getByActor($actor1);
				$smarty->assign("graphs",$graphs);
			} else {
				$actor2 = ActorPeer::retrieveByPK($request->getParameter("actor2"));

				$graphs = GraphRelationPeer::getByRelation($actor1,$actor2);
				$smarty->assign("graphs",$graphs);
			}

		}else{
			$actor2 = new Actor();
			$actors = array(''=>"Select an actor");
		}
		foreach (ActorPeer::getUserActors($_SESSION["login_user"]) as $actor){
			$actors[$actor->getId()] = $actor->getName();
		}
		unset($actors[$request->getParameter("actor")]);
		$smarty->assign("actors",$actors);
		$smarty->assign('actor2',$actor2);

		$module = "Mer";
		$section = "AnalysisRelations";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section); 

		if (empty($_GET["list"]))
			return $mapping->findForwardConfig('success');
		else
			return $mapping->findForwardConfig('list');
	}

}
?>

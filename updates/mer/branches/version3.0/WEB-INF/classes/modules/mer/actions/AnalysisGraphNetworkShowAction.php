<?php

require_once("BaseAction.php");
require_once("mer/ActorPeer.php");
require_once("mer/RelationshipPeer.php");
require_once("mer/FormPeer.php");
require_once("mer/GraphModelPeer.php");

class AnalysisGraphNetworkShowAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function AnalysisGraphNetworkShowAction() {
		;
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
    
    $this->template->template = "template_jsviz.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Mer";
		$section = "Analysis";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);
    
		$categoryId = $request->getParameter("categoryId");
		if (!empty($categoryId)) {
			$actors = ActorPeer::getByCategory($categoryId);
			$smarty->assign('categoryId',$categoryId);
		}
		else {
			$actorsIds = $_GET["actors"];
			$actors = array();
			foreach ($actorsIds as $actor) {
				$actors[] = ActorPeer::get($actor);
			}
		}
		
		$minLongitud = 180;
		$maxLongitud = -180;
		$minLatitud = 180;
		$maxLatitud = -180;
		foreach ($actors as $actor) {
			$longitud = $actor->getNumericAnswerByLabel("longitud");
			$latitud = $actor->getNumericAnswerByLabel("latitud");
			if ($longitud > $maxLongitud)
				$maxLongitud = $longitud;
			if ($longitud < $minLongitud)
				$minLongitud = $longitud;
			if ($latitud > $maxLatitud)
				$maxLatitud = $latitud;
			if ($latitud < $minLatitud)
				$minLatitud = $latitud;
		}
		
		$rangeLongitud = 580 / ($maxLongitud - $minLongitud);
		$rangeLatitud = 340 / ($maxLatitud - $minLatitud);
		$centerLongitud = ($maxLongitud + $minLongitud) /2;
		$centerLatitud = ($maxLatitud + $minLatitud) /2;
		
		$range = min($rangeLongitud,$rangeLatitud);

		$smarty->assign('rangeLongitud',$rangeLongitud);
		$smarty->assign('rangeLatitud',$rangeLatitud);
		$smarty->assign('centerLongitud',$centerLongitud);
		$smarty->assign('centerLatitud',$centerLatitud);
		$smarty->assign('range',$range);

			$questionsIds = $_GET["questions"];
			$questions = array();
			foreach ($questionsIds as $question) {
				$questions[] = QuestionPeer::get($question);
			}
			$smarty->assign('questions',$questions);
			
		$relations = Array();

 		$form = FormPeer::get($_GET["form"]);
		$questionsAll = $form->getAllQuestions();

		$colors = GraphModelPeer::getColors();
		for ($i=0;$i<count($questionsAll);$i++) {
			$index = fmod($i,count($colors));
			$questionsAll[$i]->color = $colors[$index];
		}

		foreach ($actors as $actor) {
			foreach ($actors as $actor2) {
				$relsAll = 0;
				$rels = 0;
				$relationsActor = Array();
				foreach ($questionsAll as $question) {
					$rel = $actor->getRelation($actor2,$question->getId());
					if ( !empty($rel) ) {
						$relationsInfo[$actor->getId()][$actor2->getId()][$question->getId()] = $rel;
						$current = $rel->getCurrent();
						$potential = $rel->getPotential();
						if ( !empty($rel) && ( !empty($current) || !empty($potential) ) ) {
							$relsAll++;
							if (in_array($question->getId(),$questionsIds)) {
	            	$rels++;
	            	$relationsActor[] = $question->color;
							}
						}
					}	
				}
				if ($rels > 0) {
        	foreach ($relationsActor as $relationActor)
						$relations[] = Array("actor1" => $actor->getId(), "actor2" => $actor2->getId(), "rels" => min($relsAll,8), "color" => $relationActor);
				}
			}
		}

		$smarty->assign("relations",$relations);

		$smarty->assign('actors',$actors);

		return $mapping->findForwardConfig('success');
	}

}
?>

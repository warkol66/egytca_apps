<?php
/**
 * HeadlinesReportsAction
 *
 * Listado de Actores extendiendo BaseListAction
 *
 * @package    actors
 */

class HeadlinesReportsAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Headline');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Headlines";
		
		if($_GET["report"]) {
			$this->notPaginated = true;
			$this->smarty->assign("report", true);
			$this->template->template = "TemplatePrint.tpl";
			if($_GET["includeContent"])
				$this->smarty->assign("includeContent", true);

		}

		if (!empty($_GET['filters']['issueId']))
			if (empty($_GET['filters']['getIssueBrood']))
				$this->filters['Issue']['entityFilter'] = array(
					'entityType' => "Issue",
					'entityId' => $_GET['filters']['issueId']
				);
			else
				$this->filters["broodIssues"] = $_GET['filters']['issueId'];

		if (!empty($_GET['filters']['mediaId']))
			$this->filters['Media']['entityFilter'] = array(
				'entityType' => "Media",
				'entityId' => $_GET['filters']['mediaId']
			);

		if (!empty($_GET['filters']['actorId']))
			$this->filters['Actor']['entityFilter'] = array(
				'entityType' => "Actor",
				'entityId' => $_GET['filters']['actorId']
			);
		
		if (!empty($_GET['filters']['fromDate']) || !empty($_GET['filters']['toDate']))
			$this->filters['rangePublished'] = array('range' => Common::getPeriodArray(
				$_GET['filters']['fromDate'], $_GET['filters']['toDate']
			));

		$this->filters["setReportOrder"] = true;

		if (!empty($_GET['filters']["perPage"]))
			$this->perPage = $filters["perPage"];
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Reports");

		$this->smarty->assign("headlineScopes", Headline::getHeadlineScopes());
		$this->smarty->assign("headlineValues", Headline::getHeadlineValues());
		$this->smarty->assign("headlineRelevances", Headline::getHeadlineRelevances());

		if ($this->filters["executiveSummary"]) {
			$query = clone $this->query;

			//Total titulares
			$totalHeadlines = $query->count();
			$this->smarty->assign("totalHeadlines", $totalHeadlines);

			//Resumen por temas
			$byIssueTop = IssueQuery::create()->filterByHeadline($query->find(), Criteria::IN)
				->joinHeadlineIssue()
				->groupById()
				->withColumn("COUNT(HeadlineIssue.Issueid)", "HeadlinesCount")
				->orderByHeadlinesCount(Criteria::DESC)
				->limit(10)
				->find();

			//Resumen por temas otros
			foreach ($byIssueTop as $issue)
				$already[] = $issue->getId();
			$byIssueRest = IssueQuery::create()
				->filterById($already, Criteria::NOT_IN)
				->filterByHeadline($query->find(), Criteria::IN)
				->orderByName()
				->groupById()
				->joinHeadlineIssue()
				->find();

			//Resumen por vocero
			//HRL Actor 278
			$headlinesByActor = clone $this->query;
			$headlinesByActor
				->joinHeadlineActor()
//				->filterBy("HeadlineActor.ActorId",278)
				->count()
				;

			$headlinesBySpokesman = clone $this->query;
			$headlinesBySpokesman
				->joinHeadlineActor()
//				->filterBy("HeadlineActor.ActorId",278)
//				->filterBy("HeadlineActor.Role",HeadlinePeer::SPOKESMAN)
				->count()
				;

			$this->smarty->assign("byIssueTop", $byIssueTop);
			$this->smarty->assign("byIssueRest", $byIssueRest);

			$this->smarty->assign("headlinesByActor", $headlinesByActor);
			$this->smarty->assign("headlinesBySpokesman", $headlinesBySpokesman);

		}
	}
}

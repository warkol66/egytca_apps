<?php

class CalendarAxisDoEditAction extends BaseAction {

	function CalendarAxisDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$id = $request->getParameter("id");
		$filters = $request->getParameterValues("filters");

		if (!empty($id)) {
			$axis = BaseQuery::create('CalendarAxis')->findOneById($id);
			if (!empty($axis)) {
				$params = $request->getParameterValues("params");
				$axis = Common::setObjectFromParams($axis,$params);
				if ($axis->isModified() && !$axis->save())
					return $this->addFiltersToForwards($filters,$mapping,'failure');
				else
					return $this->addFiltersToForwards($filters,$mapping,'success');
			}			
		}
		else {
			$axis = new CalendarAxis();
			$params = $request->getParameterValues("params");
			$axis = Common::setObjectFromParams($axis,$params);
			if (!$axis->save())
				return $this->addFiltersToForwards($filters,$mapping,'failure');
		}
		return $this->addFiltersToForwards($filters,$mapping,'success');
	}
}
<?php

class CalendarHolidayEventsDoDeleteAction extends BaseAction {

	function CalendarHolidayEventsDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$id = $request->getParameter('id');
    if (!empty($id)) {
			$event = BaseQuery::create('CalendarHolidayEvent')->findOneById($id);
			if (!empty($event)) {
		    $event->delete();
				if ($event->isDeleted()) {
					if (mb_strlen($event->getTitle()) > 120)
						$cont = " ... ";
					$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
					Common::doLog('success', substr($event->getTitle(), 0, 120) . $logSufix);
					return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');
				}
			}
		}
		return $this->addFiltersToForwards($_POST['filters'],$mapping,'failure');
	}

}

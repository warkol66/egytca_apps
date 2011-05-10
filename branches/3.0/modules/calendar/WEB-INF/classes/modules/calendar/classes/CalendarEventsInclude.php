<?php

require_once 'CalendarEventPeer.php';

class CalendarEventsInclude extends CalendarEventPeer {

  function getShow($options) {
    global $system;
    
    $eventsInHome = $system["config"]["calendar"]["eventsInHome"];
    
    $this->setOrderByDate();
    $this->setPublishedMode();

    $pager = $this->getAllPaginatedFiltered(1,$eventsInHome);
    $result = $pager->getResult();
    
    return $result;
  }

}
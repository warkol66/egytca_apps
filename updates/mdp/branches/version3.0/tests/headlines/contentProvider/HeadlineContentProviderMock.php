<?php

/**
 * Class HeadlineContentProviderMock.
 *
 * @author nico
 */
class HeadlineContentProviderMock extends HeadlineContentProvider {

    public static function create($keywords, $campaignId) {
        return new HeadlineContentProviderMock($keywords, $campaignId);
    }
    
    public function find(&$ignored, &$total) {
        return $this->getStrategy()->parse();
    }
    
} // HeadlineContentProviderMock

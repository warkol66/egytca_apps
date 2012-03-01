<?php

/**
 * Class CompoundStrategy.
 */
class CompoundStrategy extends AbstractParserStrategy {

    private $strategies;
    
    protected function initialize() {
        // does nothing
    }
    
    public function parse() {
        $news = array();
        foreach ($this->strategies as $strategyName => $strategy) {
            foreach ($strategy->parse() as $result)
                $news[] = $result;
        }
        return $news;
    }
    
    public function addQueryParameters(array $params) {
        foreach ($params as $strategyName => $parameters) {
            if (array_key_exists($strategyName, $this->strategies))
                $this->strategies[$strategyName]->addQueryParameters($parameters);
        }
        parent::addQueryParameters($params);
    }
    
    /**
     * Array asociativo: 'strategyName' => $strategyObject
     * 
     * @param array $strategies 
     */
    public function setStrategies(array $strategies) {
        $this->strategies = $strategies;
    }
    
} // CompoundStrategy

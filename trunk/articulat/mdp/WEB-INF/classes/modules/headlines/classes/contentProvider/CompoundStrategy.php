<?php

/**
 * Class CompoundStrategy.
 */
class CompoundStrategy extends AbstractParserStrategy {

    private $strategies;
    
    protected function initialize() {
        // does nothing
    }
    
    public function parse($url = null) {
        $news = array();
        foreach ($this->strategies as $strategyName => $strategy) {
            foreach ($strategy->parse($url) as $result)
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
    
    public function getNextQueryParameters() {
	    $params = array();
	    foreach ($this->strategies as $strategyName => $strategy) {
		    $params[$strategyName] = $strategy->getNextQueryParameters();
	    }
	    return $params;
    }
    
    public function hasErrors() {
        foreach ($this->strategies as $strategyName => $strategy) {
            if ($strategy->hasErrors()) return true;
        }
        return false;
    }
    
    public function getErrors() {
        $errors = array();
        foreach ($this->strategies as $strategyName => $strategy) {
            foreach ($strategy->getErrors() as $error) {
                $errors[] = array_merge($error, array("strategy" => $strategyName));
            }
        }
        return $errors;
    }
    
} // CompoundStrategy

<?php

// Initializer de propel
require_once '../../initializers/propel.php';

require_once '../../config/config_module.php';

set_include_path("$appDir/WEB-INF/classes/includes/" . PATH_SEPARATOR . get_include_path());
require_once 'headlines/classes/contentProvider/HeadlineContentProvider.php';
require_once 'contentProvider/HeadlineContentProviderMock.php';

$query = 'sabella';
$campaignId = 18;

//$provider = HeadlineContentProvider::create($query, $campaignId)
$provider = HeadlineContentProviderMock::create($query, $campaignId)
    ->setStrategy(array('googleNews', 'google'));

$loops = 0;
$canBringMoreResults = true;
while ($canBringMoreResults) {
    $loops++;
    echo "Loop number $loops\n";
    
    echo "Deleting headlines parsed\n";
    HeadlineParsedQuery::create()->deleteAll();
    
    echo "Fetching content\n";
    $rawData = $provider->find($ignored, $total);
    $count   = count($rawData);
    echo "Content found {$count}\n";
    
    foreach ($rawData as $data) {
        echo " -> title: {$data['title']}\n";
    }
    
    if ($provider->hasErrors()) {
        echo "Hubo errores de parseo:\n";
        foreach ($provider->getErrors() as $error) {
            echo " -> code: {$error["code"]}, message: {$error["message"]}, strategy: {$error["strategy"]}\n";
        }
    }
    
    echo "\n\n";
    
    if ($count == 0) $canBringMoreResults = false;
}

<?php
require __DIR__ . '/vendor/autoload.php';

use Yurun\Util\HttpRequest;
use Yurun\Util\YurunHttp\Co\Batch;

go(function(){
    $requests = [];
    for($i = 0; $i < 10000; ++$i)
    {
        $requests[] = (new HttpRequest)->url('http://127.0.0.1:65432/');
    }
    $time = microtime(true);
    $results = Batch::run($requests);
    echo 'Use time: ', microtime(true) - $time, 's', PHP_EOL;

    $success = $fail = 0;
    foreach($results as $result)
    {
        if(200 === $result->getStatusCode())
        {
            ++$success;
        }
        else
        {
            ++$fail;
        }
    }
    echo 'success:', $success, ', fail: ', $fail, PHP_EOL;
    
});

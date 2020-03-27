<?php

use Swlib\SaberGM;
require __DIR__ . '/vendor/autoload.php';

go(function () {
    $time = microtime(true);
    $results = [];
    for($i = 0; $i < 10000; ++$i)
    {
        $results[] = SaberGM::get('http://127.0.0.1:65432/');
    }
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

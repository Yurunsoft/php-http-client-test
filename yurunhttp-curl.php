<?php
require __DIR__ . '/vendor/autoload.php';

use Yurun\Util\HttpRequest;

$http = new HttpRequest;
$results = [];
$time = microtime(true);
for($i = 0; $i < 10000; ++$i)
{
    $results[] = $http->get('http://127.0.0.1:65432/');
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


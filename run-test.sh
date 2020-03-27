#!/bin/sh

__DIR__=$(cd `dirname $0`; pwd)

echo "---single---"

echo "\nguzzle:"
php $__DIR__/guzzle.php

echo "\nsaber:"
php $__DIR__/saber.php

echo "\nyurunhttp-swoole:"
php $__DIR__/yurunhttp-swoole.php

echo "\nyurunhttp-curl:"
php $__DIR__/yurunhttp-curl.php

echo "\n---batch---"

echo "\nguzzle-batch:"
php $__DIR__/guzzle-batch.php

echo "\nsaber-batch:"
php $__DIR__/saber-batch.php

echo "\nyurunhttp-curl-batch:"
php $__DIR__/yurunhttp-curl-batch.php
echo "\nyurunhttp-swoole-batch:"
php $__DIR__/yurunhttp-swoole-batch.php

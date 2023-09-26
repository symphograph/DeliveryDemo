<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/vendor/autoload.php';
echo 'index';
throw new \Symphograph\Bicycle\Errors\AppErr('jhj', 'hhhhh');
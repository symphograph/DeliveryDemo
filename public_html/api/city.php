<?php

use App\CTRL\CityCTRL;
use Symphograph\Bicycle\Errors\ApiErr;
use Symphograph\Bicycle\Errors\ValidationErr;

require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/vendor/autoload.php';
if (empty($_GET['method'])) {
    throw new ValidationErr();
}

match ($_GET['method']) {
    'list' => CityCTRL::list(),
    default => throw new ApiErr()
};
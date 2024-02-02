<?php

use ExadsChallenge\Console\ASCIIArrayCommand;
use ExadsChallenge\Console\PrimeNumbersCommand;
use Symfony\Component\Console\Application;

require_once dirname(__DIR__) . '/vendor/autoload.php';

try {
    $application = new Application();

    $application->add(new PrimeNumbersCommand());
    $application->add(new ASCIIArrayCommand());

    exit($application->run());
} catch (Throwable $exception) {
    echo $exception->getMessage();
    exit(1);
}

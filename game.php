<?php
declare(strict_types=1);
require_once "vendor/autoload.php";

unset($argv[0]);

$playerNamesList = $argv;

(new \Dominoes\Play($playerNamesList, (new \Dominoes\Board())));

echo "Done!\r\n";
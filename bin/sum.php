<?php
// Prints out summary and
require __DIR__ . '/../vendor/autoload.php';
use gregoryv\timesheet\Calculator;
if(!file_exists($argv[1])) {
    print "Nu such file: $argv[1]\n";
    exit(1);
}
$sheet = file_get_contents($argv[1]);
$calc = new Calculator();
printf("%s\n", $calc->sum($sheet));

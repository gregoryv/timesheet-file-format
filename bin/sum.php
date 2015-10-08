<?php
require __DIR__ . '/../vendor/autoload.php';
use gregoryv\timesheet\Calculator;

/**
  *  Prints out summary of one or more timesheet files.
  */
$calc = new Calculator();
$totals = array();
$calc->addAll($argv, $totals);
print toLine($totals);

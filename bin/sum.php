<?php
/**
  *  Prints out summary of one or more timesheet files.
  */
require __DIR__ . '/../vendor/autoload.php';
use gregoryv\timesheet\Calculator;

$calc = new Calculator();

# Sum all values in all reports
$totals = array();
foreach ($argv as $file) {
  $sheet = file_get_contents($file);
  $calc->sum($sheet, $totals);
}

# Print out summary
$line = "";
foreach ($totals as $k => $v) {
  $line .= sprintf("%s=%s ", $k, $v);
}
print rtrim($line) ."\n";

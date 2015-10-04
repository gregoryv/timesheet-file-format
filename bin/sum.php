<?php
// Prints out summary and
require __DIR__ . '/../vendor/autoload.php';
use gregoryv\timesheet\Calculator;

# Sum all values in all reports
$totals = array();
foreach ($argv as $file) {
  $sheet = file_get_contents($file);
  $calc = new Calculator();
  $calc->sum($sheet, $totals);
}

# Print out summary
$line = "";
foreach ($totals as $k => $v) {
  $line .= sprintf("%s=%s ", $k, $v);
}
print rtrim($line) ."\n";

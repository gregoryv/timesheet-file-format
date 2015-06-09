<?php
// Command line interface for generating and summarizing timesheets
require __DIR__ . '/../vendor/autoload.php';

use gregoryv\timesheet\TemplateGenerator;

$opts = getopt('y:m:');
validate_options($opts);
$g = new TemplateGenerator();
print $g->month($opts['y'], $opts['m']);


function print_help($error)
{
    print $error;
    exit(1);
}

/**
 * @return array of key value options
 */
function validate_options(&$opts)
{
    list($year, $err) = getInt($opts, 'y');
    if($err) { print_help('-y YYYY required'); };

    list($month, $err) = getInt($opts, 'm');
    if($err) { print_help('-m [1-12] required'); };

    if($year < 1000) {
        print_help("Year must be four digits: $year");
    }

    if($month < 1 or $month > 12) {
        print_help("Month must be 1-12: $month");
    }
    return $opts;
}

function getInt(&$arr, $key)
{
    if(isset($arr[$key])) {
        $value = intval($arr[$key]);
        return array($value, false);
    }
    return array(null, true);
}


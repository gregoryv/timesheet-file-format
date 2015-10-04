<?php
// Command line interface for generating timesheets
require __DIR__ . '/../vendor/autoload.php';
use gregoryv\timesheet\TemplateGenerator;

# Verify commandline options
$opts = getopt('y:m:');
$yyyy = getInt($opts, 'y', 1000, 9999) || usage();
$mm   = getInt($opts, 'm',    1,   12) || usage();
# Render template
print (new TemplateGenerator())->generate($yyyy, $mm);

/**
 * Print usage information and exit.
 */
function usage()
{
    print "timesheet.php -y YYYY -m [1-12]";
    exit(1);
}

/**
 *
 * @return mixed if the value is ok false otherwise
 */
function getInt(&$arr, $key, $from, $to)
{
    if(!isset($arr[$key])) {
        return false;
    }
    # Check range
    $value = intval($arr[$key]);
    return ($value >= $from && $value <= $to) ? $value : false;
}


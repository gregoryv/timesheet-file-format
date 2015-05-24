<?php
require __DIR__ . '/../vendor/autoload.php';

use gregoryv\timereport\TemplateGenerator;


$g = new TemplateGenerator();

print $g->month($argv[1], $argv[2]);

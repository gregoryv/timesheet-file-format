<?php
namespace gregoryv\timesheet;
require 'utils.php';

/**
* Math operations for time reports
*/
class Calculator
{

    /**
     * Adds summary from the given report to totals
     *
     * @param string $report to scan for values
     * @param array $totals reference to array where sums are added, may be empty
     */
    public function sum($report, &$totals)
    {
        foreach ($this->parse($report) as $k => $v) {
            addTo($totals, $k, $v);
        }
    }


    /**
     * Summarizes reported and tagged hours. 
     * Tagged hours are written in the form ([+|-]hours tagword)
     *
     * @return array with summary for each tag in the report
     */
    public function parse($report)
    {
        $result = array('sum' => 0);
        $lines = explode("\n", $report);
        foreach ($lines as $line) {
            # Skip comments
            if(preg_match("/^#/", $line)) {
                continue;
            }
            # Reported hours
            if(preg_match("/^.{10,10}(\d).*$/", $line, $matches)) {
                $result['sum'] += $matches[1];
            }
            # Taggs
            if(preg_match_all("/\(([\+|-]?\d+)\s+([^\s|\)]+)\s*\)/", $line, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $items) {
                    $tag = $items[2];
                    addTo($result, $tag, $items[1]);
                }
            }
        }
        return $result;
    }
}

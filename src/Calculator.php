<?php
namespace gregoryv\timesheet;
require 'utils.php';

/**
* Math operations for timesheets.
*/
class Calculator
{
    /**
     * Adds summary from the given sheet to totals
     *
     * @param string &$sheet to scan for values
     * @param array $totals reference to array where sums are added, may be empty
     */
    public function add(&$sheet, &$totals)
    {
        foreach ($this->sum($sheet) as $k => $v) {
            addTo($totals, $k, $v);
        }
    }

    /**
     * Summarizes reporteded and tagged hours. 
     * Tagged hours are written in the form ([+|-]hours tagword)
     *
     * @return array with summary for each tag in the sheet
     */
    public function sum(&$sheet)
    {
        $totals = array('sum' => 0);
        $lines = explode("\n", $sheet);
        foreach ($lines as $line) {
            # Skip comments
            if(preg_match("/^#/", $line)) {
                continue;
            }
            # Reported hours
            if(preg_match("/^.{10,10}(\d).*$/", $line, $matches)) {
                $totals['sum'] += $matches[1];
            }
            # Tags
            if(preg_match_all("/\(([\+|-]?\d+)\s+([^\s|\)]+)\s*\)/", $line, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $items) {
                    addTo($totals, $items[2], $items[1]);
                }
            }
        }
        return $totals;
    }
}

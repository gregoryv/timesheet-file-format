<?php
namespace gregoryv\timesheet;

/**
* Math operations for time reports
*/
class Calculator
{

    /**
     * Returns a string with
     *
     *  sum=hours tag1=hours ... tagN=hours
     *
     * @return string
     */
    public function sum($report)
    {
        $sum = sprintf("sum=%s", $this->reported($report));
        foreach ($this->tagged($report) as $key => $value) {
            $sum .= sprintf(" %s=%s", $key, $value);
        }
        return $sum;
    }

    /**
     * Sums all reported hours.
     *
     * @return integer sum of all reported hours
     */
    public function reported($report)
    {
        $sum = 0;
        $lines = explode("\n", $report);
        foreach ($lines as $line) {
            if(preg_match("/^#/", $line)) {
                continue;
            }
            if(preg_match("/^.{10,10}(\d).*$/", $line, $matches)) {
                $sum += $matches[1];
            }
        }
        return $sum;
    }

    /**
     * Tagged hours are written in the form ([+|-]hours tagword)
     *
     * @return array with summary for each tag in the report
     */
    public function tagged($report)
    {
        $result = array();
        $lines = explode("\n", $report);
        foreach ($lines as $line) {
            if(preg_match("/^#/", $line)) {
                continue;
            }
            if(preg_match_all("/\(([\+|-]?\d+)\s+([^\s|\)]+)\s*\)/", $line, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $items) {
                    $tag = $items[2];
                    if(!isset($result[$tag])) {
                        $result[$tag] = 0;
                    }
                    $result[$tag] += $items[1];
                }
            }
        }
        return $result;
    }
}

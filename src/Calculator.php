<?php
namespace gregoryv\timereport;

/**
* Math operations for time reports
*/
class Calculator
{

    /**
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
}

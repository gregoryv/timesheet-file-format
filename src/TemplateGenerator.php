<?php
namespace gregoryv\timesheet;

/**
* Generates timereport templates
*/
class TemplateGenerator
{
    /**
     * Text template with week numbers and indented days.
     *
     * @return string Monthly template with 8 hours for each weekday
     */
    public function generate($year, $month, $hours = 8)
    {
        $first = sprintf('%s-%s-01', $year, $month);
        $begin = new \DateTime( $first );
        $end  = (new \DateTime( $first ))->modify( '+1 month' );
        $range = new \DatePeriod($begin, new \DateInterval('P1D') ,$end);

        # YYYY Month
        # ----------
        $template  = sprintf("%s %s", $year, $begin->format('F'));
        $template .= sprintf("\n%s\n", preg_replace('/./', '-', $template));

        $lines = array();
        foreach($range as $date) {
            $day = $date->format("D");
            # Only Saturday or Sunday start with 'S'
            $dayh = ($day[0] == 'S') ? $day : $day . " " . $hours;
            $week = ($day == 'Mon' || empty($lines)) ? $date->format("W") : "";
            $lines[] = sprintf("%2s %2s %s", $week, $date->format("j"), $dayh);
        }
        return $template . implode("\n", $lines) . "\n";
    }
}

<?php
namespace gregoryv\timesheet;

/**
* Generates timereport templates
*/
class TemplateGenerator
{

    /**
     * @return string monthly template with 8 hours for each weekday
     */
    public function month($year, $month)
    {
        $start_date = sprintf('%s-%s-01', $year, $month);
        $end_date = sprintf('%s-%s-31', $year, $month);
        $begin = new \DateTime( $start_date );
        $end = new \DateTime( $start_date );
        $end = $end->modify( '+1 month' );

        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($begin, $interval ,$end);
        $template = sprintf("%s %s", $year, $begin->format('F'));
        $line = preg_replace('/./', '-', $template);
        $template .= "\n$line\n";

        $first_day = true;
        foreach($daterange as $date){
            $week = "";
            $day = sprintf("%2s", $date->format("j"));
            $wday = $date->format("D");
            $hours = " 8";

            switch ($date->format("D")) {
                case 'Mon':
                    $week = sprintf("%2s", $date->format("W"));
                    break;

                case 'Sat':
                case 'Sun':
                    $hours = "";
                    break;

            }
            if($first_day) {
                $week = sprintf("%2s", $date->format("W"));
                $first_day = false;
            }
            $template .= sprintf("%2s %s %s%s\n", $week, $day, $wday, $hours);

        }
        return $template;
    }

}

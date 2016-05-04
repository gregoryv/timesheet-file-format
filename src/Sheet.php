<?php
namespace gregoryv\timesheet;

/**
 * Sheet is used to parse .ets files
 */
class Sheet
{
    public function __construct(&$str)
    {
      $this->str = $str;
    }

    /**
     * Each reported and tagged times are returned as TimeTag objects in the order they
     * are found.
     *
     * @return array of TimeTag objects.
     */
    public function readTimeTags()
    {
        $arr = array();
        $lines = explode("\n", $this->str);
        foreach ($lines as $line) {
            # Skip comments
            if(preg_match("/^#/", $line)) {
                continue;
            }
            # Reported hours
            $min = "(:(\d\d))?";
            if(preg_match("/^.{10,10}(\d)$min.*$/", $line, $matches)) {
                $mm = (sizeof($matches) === 4) ? $matches[3] : 0;
                $arr[] = new TimeTag($matches[1], $mm);
            }
            # Tags
            if(preg_match_all("/\((([\+|-]?)\d+)$min\s+([^\s|\)]+)\s*\)/", $line, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $items) {
                    $hh = $items[1];
                    $operator = $items[2];
                    $mm = $items[4];
                    $tag = $items[5];
                    $mm = ($mm === '') ? 0 : $operator . $mm;
                    $arr[] = new TimeTag($hh, $mm, $tag);
                }
            }
        }
        return $arr;
    }
}


<?php
namespace gregoryv\timesheet;

/**
 * TimeTag defines two integers hours:minutes
 */
class TimeTag
{
    public $hours;
    public $minutes;
    public $tag;

    public function __construct($h=0, $m=0, $tag="sum")
    {
      $hh = intval($h);
      $mm = intval($m);
      switch (true) {
        case !is_numeric($h):
        case !is_numeric($m):
        case floatval($h) != $hh:
        case floatval($m) != $mm:
          throw new \InvalidArgumentException("h and m must be integers");
        default:
          break; // All is ok
      }
      $this->hours = $hh;
      $this->minutes = $mm;
      $this->tag = $tag;
    }

    public function add($time)
    {
      $this->hours += $time->hours;
      $this->minutes += $time->minutes;
    }

    /**
     * @return string in format [-]\d+[:mm]
     */
    public function toString()
    {
      $mm = $this->hours * 60 + $this->minutes;
      $hh = ($mm < 0) ? ceil($mm / 60) : floor($mm / 60);
      $mm = abs($mm % 60);
      if($mm != 0) {
        return sprintf('%s:%02s', $hh, $mm);
      }
      return $hh;
    }
}


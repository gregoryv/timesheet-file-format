<?php
namespace gregoryv\timesheet;

/**
* Totals holds keyed summary values
*/
class Totals extends \ArrayObject
{

  
  /**
   * Sets default value of the key, if not already set.
   *
   * @param string $key Key in array to set
   * @param Time obj default time
   */
  function setDefault($time)
  {
    $key = $time->tag;
    $this[$key] = isset($this[$key]) ? $this[$key] : $time;
  }

  /**
   * Adds the value to the keyed value, default is 0.
   *
   * @param string $key Key in array to set
   * @param Time $time The time to add to an existing one
   */
  function add($time) {
    $key = $time->tag;
    if(!isset($this[$key])) {
      $this[$key] = new Time();
    }
    $this[$key]->add($time);
  }

  /**
   * @return string oneline summary with key=value pairs
   */
  function toLine()
  {
    $line = "";
    foreach ($this as $k => $v) {
      switch($v->minutes) {
        case 0:
          $line .= sprintf("%s=%s ", $k, $v->hours);
          break;
        default:
          $line .= sprintf("%s=%s ", $k, $v->toString());
      }
    }
    return rtrim($line) ."\n";
  }
}

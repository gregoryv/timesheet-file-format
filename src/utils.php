<?php
namespace gregoryv\timesheet;

/**
 * Sets default value of the key in the given array if not already set.
 *
 * @param array $arr Reference to array
 * @param string $key Key in array to set
 * @param mixed $value The default value to set
 */
function setDefault(&$arr, $key, $value)
{
  $arr[$key] = isset($arr[$key]) ? $arr[$key] : $value;
}

/**
 * Adds the value to the keyed value, default is 0.
 *
 * @param array $arr Reference to array
 * @param string $key Key in array to set
 * @param number $value The value to add to an existing one
 */
function addTo(&$arr, $key, $value) {
  setDefault($arr, $key, 0);
  $arr[$key] += $value;
}

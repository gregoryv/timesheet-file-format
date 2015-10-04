<?php
/**
 * Sets default value of the key in the given array if not already set.
 */
function setDefault(&$arr, $key, $value)
{
  $arr[$key] = isset($arr[$key]) ? $arr[$key] : $value;
}

/**
 * Adds the value to the keyed value, default is 0.
 */
function addTo(&$arr, $key, $value) {
  setDefault($arr, $key, 0);
  $arr[$key] += $value;
}

<?php

use gregoryv\timesheet\Calculator;

class CalculatorTest extends PHPUnit_Framework_TestCase {

    function setUp() {
        $this->calc = new Calculator();
        $this->sheet = file_get_contents(__DIR__ . '/../data/201505.trep');
        $this->sheet .= "\n# some documentation here\n";
    }

    /**
     * @test
     * @group unit
    */
    public function add_test()
    {
        $expected = array(
            'sum'  => 152,
            'kö'   => 9,
            'flex' => 5,
            'ö'    => 1);
        $totals = array();
        $this->calc->add($this->sheet, $totals);
        $this->assertEquals($expected, $totals);
    }

    /**
    * @test
    * @group unit
    */
    function sum_hours_in_timesheet() {
        $expected = array(
            'sum' => 152,
            'ö' => 1,
            'kö' => 9,
            'flex' => 5
        );
        $this->assertEquals($expected, $this->calc->sum($this->sheet));
    }
}

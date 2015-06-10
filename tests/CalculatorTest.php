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
    public function sum_test()
    {
        $expected = "sum=152 kö=9 flex=5 ö=1";
        $this->assertEquals($expected, $this->calc->sum($this->sheet));
    }

    /**
    * @test
    * @group unit
    */
    function reported_time_summary() {
        $this->assertEquals(152, $this->calc->reported($this->sheet));
    }

    /**
    * @test
    * @group unit
    */
    function tagged_hour_summary() {
        $expected = array(
            'ö' => 1,
            'kö' => 9,
            'flex' => 5
        );
        $this->assertEquals($expected, $this->calc->tagged($this->sheet));

    }
}

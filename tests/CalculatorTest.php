<?php

use gregoryv\timesheet\TemplateGenerator;
use gregoryv\timesheet\Calculator;

class CalculatorTest extends PHPUnit_Framework_TestCase {

    function setUp() {
        $this->gen = new TemplateGenerator();
        $this->calc = new Calculator();
    }

    /**
    * @test
    * @group unit
    */
    function reported_time_summary() {
        $may = $this->gen->month(2015,5); # 168 hours manually calculated
        // Adding a comment string
        $may .= "\n# some documentation here\n";
        $this->assertEquals(168, $this->calc->reported($may));
    }

    /**
    * @test
    * @group unit
    */
    function tagged_hour_summary() {
        $trep = file_get_contents(__DIR__ . '/../data/201505.trep');
        $expected = array(
            'ö' => 1,
            'kö' => 9,
            'flex' => 5
        );
        $this->assertEquals($expected, $this->calc->tagged($trep));

    }

}

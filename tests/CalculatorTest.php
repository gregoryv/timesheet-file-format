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
        $may = $this->gen->month(2015,5);
        $this->assertEquals($this->calc->reported($may), 168);
    }

}

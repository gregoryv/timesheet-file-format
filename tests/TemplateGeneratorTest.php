<?php

use gregoryv\timereport\TemplateGenerator;

class TemplateGeneratorTest extends PHPUnit_Framework_TestCase {

    function setUp() {
        $g = new TemplateGenerator();
        // months go from 1-12
        $this->template = $g->month(2015, 5);
        $this->lines = explode("\n", $this->template);
    }

    /**
    * @test
    * @group unit
    */
    function starts_with_year_and_month() {
        $this->assertEquals(array(
            "2015 May",
            "--------",
            "18  1 Fri 8",
            "    2 Sat",
            "    3 Sun",
            "19  4 Mon 8",
            "    5 Tue 8",
            "    6 Wed 8",
            "    7 Thu 8",
            "    8 Fri 8",
            "    9 Sat",
            "   10 Sun",
            "20 11 Mon 8",
            "   12 Tue 8",
            "   13 Wed 8",
            "   14 Thu 8",
            "   15 Fri 8",
            "   16 Sat",
            "   17 Sun",
            "21 18 Mon 8",
            "   19 Tue 8",
            "   20 Wed 8",
            "   21 Thu 8",
            "   22 Fri 8",
            "   23 Sat",
            "   24 Sun",
            "22 25 Mon 8",
            "   26 Tue 8",
            "   27 Wed 8",
            "   28 Thu 8",
            "   29 Fri 8",
            "   30 Sat",
            "   31 Sun",
            ""
            ),
            $this->lines
        );
    }

}

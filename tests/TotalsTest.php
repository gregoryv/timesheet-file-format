<?php
use gregoryv\timesheet\Totals;
use gregoryv\timesheet\Time;

class TotalsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @group unit
     */
    public function setDefault_ok()
    {
        $t = new Totals();
        $time = new Time();
        $t->setDefault(new Time(2,3,'default'));
        $this->assertEquals(2, $t['default']->hours);
        $this->assertEquals(3, $t['default']->minutes);
        $t->setDefault(new Time(0,0,'defaul'));
        $this->assertEquals(2, $t['default']->hours);
        $this->assertEquals(3, $t['default']->minutes);
    }

    /**
     * @test
     * @group unit
     */
    public function toLine_ok()
    {
        $t = new Totals();
        $t->setDefault(new Time(0,0, 'sum'));
        $t->add(new Time(1,1,'sum'));
        $t->add(new Time(16,0, 'vacation'));

        $result = $t->toLine();
        $this->assertContains("sum=", $result);
        $this->assertContains("vacation=", $result);
    }
}


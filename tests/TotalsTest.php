<?php
use gregoryv\timesheet\Totals;
use gregoryv\timesheet\TimeTag;

class TotalsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @group unit
     */
    public function setDefault_ok()
    {
        $t = new Totals();
        $time = new TimeTag();
        $t->setDefault(new TimeTag(2,3,'default'));
        $this->assertEquals(2, $t['default']->hours);
        $this->assertEquals(3, $t['default']->minutes);
        $t->setDefault(new TimeTag(0,0,'defaul'));
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
        $t->setDefault(new TimeTag(0,0, 'sum'));
        $t->add(new TimeTag(1,1,'sum'));
        $t->add(new TimeTag(16,0, 'vacation'));

        $result = $t->toLine();
        $this->assertContains("sum=", $result);
        $this->assertContains("vacation=", $result);
    }
}


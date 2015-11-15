<?php
use gregoryv\timesheet\Time;

class TimeTest extends PHPUnit_Framework_TestCase
{

  function ok_times() {
    return array(
      array(0, 10),
      array("2", 20),
      array("5", "59"),
      array(-3, -45),
      array(34, -3),
      array(3.0, -1.0)
    );
  }

  /**
   * @test
   * @dataProvider ok_times
   * @group unit
   */
  public function test_ok_values($h, $m)
  {
    $time = new Time($h, $m);
    $this->assertEquals($time->hours, $h);
    $this->assertEquals($time->minutes, $m);
    $this->assertInternalType('int', $time->hours);
    $this->assertInternalType('int', $time->minutes);
  }

  function bad_times()
  {
    return array(
      array(4.3, 10),
      array(10, 9.9),
      array(1.65, 3.4),
      array(-1.1, 45),
      array(0, -32.4)
    );
  }

  /**
   * @test
   * @dataProvider bad_times
   * @group unit
   * @expectedException InvalidArgumentException
   */
  public function test_bad_values($h, $m)
  {
    $time = new Time($h, $m);
  }

  /**
   * @test
   * @group unit
   */
  public function add()
  {
    $a = new Time();
    $b = new Time(1, 2);
    $a->add($b);
    $this->assertEquals($a->hours, 1);
    $this->assertEquals($a->minutes, 2);
  }

  /**
   * @test
   * @group unit
   */
  public function add_negative_hours()
  {
    $a = new Time();
    $b = new Time(-1);
    $a->add($b);
    $this->assertEquals($a->hours, -1);
    $this->assertEquals($a->minutes, 0);
    $a->add(new Time(1));
    $this->assertEquals($a->hours, 0);
  }

  /**
   * @test
   * @group unit
   */
  public function test_negative_minutes()
  {
    $a = new Time();
    $b = new Time(0, -10);
    $a->add($b);
    $this->assertEquals($a->hours, 0);
    $this->assertEquals($a->minutes, -10);
    $a->add(new Time(0, 10));
    $this->assertEquals($a->minutes, 0);
  }


  public function toString_data()
  {
    return array(
        array( 0,  -75, '-1:15'),
        array( 2,  -75,  '0:45'),     
        array(-2,  125,  '0:05'),        
        array(-1, -125, '-3:05'), 
        array( 1,    0,  '1'),
        array(-1,    0,  '-1')
      );
  }

  /**
   * @test
   * @dataProvider toString_data
   * @group unit
   */
  public function test_toString($h, $m, $expected)
  {
    $t = new Time($h, $m);
    $this->assertEquals($expected, $t->toString());
  }
}


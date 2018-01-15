<?php
namespace basuregami\Test;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasic()
    {

        $stack = [];
        $this->assertEquals(0, count($stack));
    }

}

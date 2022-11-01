<?php

use App\Util\HelloWorld;
use PHPUnit\Framework\TestCase;

class HelloWorldTest extends TestCase {
    public function testHello() {
        $helloWorld= new HelloWorld();
        $resulat = $helloWorld->hello('Ju');
        $this->assertEquals("Hello Ju", $resulat);
    }
}

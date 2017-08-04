<?php

use Staempfli\Eyebase\Api;

class ApiTest extends PHPUnit_Framework_TestCase
{
    private $api;

    public function __construct()
    {
        $this->api = new Api();
        parent::__construct();
    }

    public function testDefaultVersion()
    {
        $this->assertSame(1, $this->api->getVersion());
    }

    public function testDefaultOutputFormat()
    {
        $this->assertSame('xml', $this->api->getOutputFormat());
    }
}

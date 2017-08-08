<?php

use Staempfli\Eyebase\Api;

class ApiTest extends PHPUnit_Framework_TestCase
{
    private $api;

    public function __construct()
    {
        $this->api = new Api('http://localhost:8082', 'TEST_TOKEN');
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

    public function testReturnResultAsSimpleXMLElement()
    {
        $result = $this->api->getApiVersion();
        $this->assertInstanceOf(SimpleXMLElement::class, $result);
    }

    public function testReturnResultAsArray()
    {
        $result = $this->api->setOutputFormat('array')->getApiVersion();
        $this->assertTrue(is_array($result));
    }

    public function testReturnResultAsJson()
    {
        $string = '{"version":{"id":"1.0.0","name":"eyebase TEST API v1.0.0"}}';
        $result = $this->api->setOutputFormat('json')->getApiVersion();
        $this->assertTrue(is_string($result));
        $this->assertSame($string, $result);
    }

    public function testLoginStatus()
    {
        $result = $this->api->getLoginStatus();
        $this->assertSame('User logged out.', (string) $result->message->text);
    }

    public function testLoginSuccess()
    {
        $result = $this->api->login('api', 'api');
        $this->assertSame('Login successful', (string) $result->user->message);
    }

    public function testLoginFailed()
    {
        $result = $this->api->login('api', 'test');
        $this->assertSame('Login failed', (string) $result->user->message);
    }
}

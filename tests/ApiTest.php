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
        try {
            $this->api->login('api', 'test');
        } catch (\Exception $e) {
            $this->assertSame('Benutzername oder Passwort ungueltig.', $e->getMessage());
        }
    }

    public function testLogout()
    {
        $result = $this->api->logout();
        $this->assertSame('Logged out successfully.', (string) $result->message->text);
    }

    public function testAvailableMediaAssetTypes()
    {
        $result = $this->api->getAvailableMediaAssetTypes();
        $this->assertSame(2, (int) $result->mediaassettypes['count']);
        $this->assertSame(501, (int) $result->mediaassettypes[0]->mediaassettype->id);
        $this->assertSame('Bilder', (string) $result->mediaassettypes[0]->mediaassettype->name);
    }

    public function testGetFolderTree()
    {
        $result = $this->api->getFolderTree();
        $this->assertSame(1300, (int) $result->folder->id);
        $this->assertSame('DEMOFOLDER', (string) $result->folder->name);
        $this->assertSame(1, (int) $result->folder->subfolders['count']);
        $this->assertSame(1301, (int) $result->folder->subfolders[0]->folder->id);
        $this->assertSame('DEMO', (string) $result->folder->subfolders[0]->folder->name);
    }

    public function testGetAvailableLanguages()
    {
        $result = $this->api->getAvailableLanguages();
        $this->assertSame(1, (int) $result->languages->language->id);
        $this->assertSame('English', (string) $result->languages->language->name);
    }

    public function testGetAvailableMediaAssetTypes()
    {
        $result = $this->api->getAvailableMediaAssetTypes();
        $this->assertSame(501, (int) $result->mediaassettypes[0]->mediaassettype->id);
        $this->assertSame('Bilder', (string) $result->mediaassettypes[0]->mediaassettype->name);
    }
}

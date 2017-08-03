<?php

namespace Staempfli\Eyebase;

use GuzzleHttp\Client;

class Api extends Eyebase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * Api constructor.
     * @param string $url
     * @param string $token
     */
    public function __construct(string $url = '', string $token = '')
    {
        $this->client = new Client();
        $this->setUrl($url);
        $this->setToken($token);
    }

    /**
     * @param array $params
     * @return string
     */
    public function request(array $params = [])
    {
        $parameters = array_merge($this->getDefaultParams(), $params);
        $url = sprintf(
            '%s/api/%d/webmill.php?%s',
            rtrim($this->getUrl(), '/'),
            $this->getVersion(),
            http_build_query($parameters)
        );

        $response = $this->client->get($url);
        $content = $response->getBody()->getContents();
        return $this->convertXmlToJson($content);
    }

    /**
     * @param string $xml
     * @return string
     */
    private function convertXmlToJson(string $xml)
    {
        $simpleXMLElement = simplexml_load_string($xml, null, LIBXML_NOCDATA);
        return json_encode($simpleXMLElement);
    }

    /**
     * @return string
     */
    public function getApiVersion()
    {
        return $this->request(['qt' => 'version']);
    }

    /**
     * @return string
     */
    public function getLoginStatus()
    {
        return $this->request(['qt' => 'loginstatus']);
    }

    /**
     * @return string
     */
    public function getFolderTree()
    {
        return $this->request(['qt' => 'ftree']);
    }

    /**
     * @return string
     */
    public function getAvailableLanguages()
    {
        return $this->request(['qt' => 'lang']);
    }

    /**
     * @return string
     */
    public function getAvailableMediaAssetTypes()
    {
        return $this->request(['qt' => 'mat']);
    }

    /**
     * @param string $text
     * @return string
     */
    public function fullTextSearch(string $text)
    {
        return $this->request(['ftx' => $text]);
    }
}

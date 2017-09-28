<?php
/**
 * @copyright Copyright © 2017 Stämpfli AG. All rights reserved.
 * @author Marcel Hauri <marcel.hauri@staempfli.com>
 */
namespace Staempfli\Eyebase;

use GuzzleHttp\Client;

/**
 * Class Eyebase
 * @package Staempfli\Eyebase
 */
abstract class Eyebase
{
    const DEFAULT_API_VERSION = 1;
    const DEFAULT_OUTPUT_FORMAT = 'xml';

    /**
     * @var Client
     */
    private $client;
    /**
     * @var int
     */
    private $version = self::DEFAULT_API_VERSION;
    /**
     * @var string
     */
    private $url = '';
    /**
     * @var string
     */
    private $username = '';
    /**
     * @var string
     */
    private $password = '';
    /**
     * @var string
     */
    private $token = '';
    /**
     * @var string
     */
    private $outputFormat = self::DEFAULT_OUTPUT_FORMAT;
    /**
     * @var array
     */
    private $defaultParams = [
        'fx' => 'api',
        'qt' => 'r'
    ];

    /**
     * Eyebase constructor.
     * @param string $url
     * @param string $token
     */
    public function __construct(string $url = '', string $token = '')
    {
        $this->client = new Client();
        $this->setUrl($url);
        $this->setToken($token);
    }

    public function getVersion() : int
    {
        return (int) $this->version;
    }

    /**
     * @param int $version
     * @return $this
     */
    public function setVersion(int $version)
    {
        $this->version = $version;
        return $this;
    }

    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    public function getToken() : string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken(string $token)
    {
        $this->token = $token;
        return $this;
    }

    public function getOutputFormat() : string
    {
        return $this->outputFormat;
    }

    /**
     * @param string $outputFormat
     * @return $this
     */
    public function setOutputFormat(string $outputFormat)
    {
        if (in_array($outputFormat, ['xml', 'json', 'array'])) {
            $this->outputFormat = $outputFormat;
        }
        return $this;
    }

    /**
     * @param array $params
     * @return array|\SimpleXMLElement|string
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
        return $this->formatOutput($content);
    }

    protected function getDefaultParams() : array
    {
        $params = $this->defaultParams;
        $params['benutzer'] = $this->getUsername();
        $params['ben_kennung'] = $this->getPassword();
        $params['token'] = $this->getToken();
        return array_filter($params);
    }

    /**
     * @param $content
     * @return array|\SimpleXMLElement|string
     */
    private function formatOutput($content)
    {
        switch ($this->getOutputFormat()) {
            case 'xml':
                $output = $this->convertContentToXml($content);
                break;
            case 'json':
                $output = $this->convertContentToJson($content);
                break;
            case 'array':
                $output = $this->convertContentToArray($content);
                break;
            default:
                $output = $content;
                break;
        }
        return $output;
    }

    private function convertContentToXml(string $content) : \SimpleXMLElement
    {
        return simplexml_load_string($content, null, LIBXML_NOCDATA);
    }

    private function convertContentToJson(string $content) : string
    {
        $xml = $this->convertContentToXml($content);
        return json_encode($xml);
    }

    private function convertContentToArray(string $content) : array
    {
        $json = $this->convertContentToJson($content);
        return json_decode($json, true);
    }
}

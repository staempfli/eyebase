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
     * @param int $folderId
     * @return string
     */
    public function getFolderTree(int $folderId = 0)
    {
        $params = ['qt' => 'ftree'];

        if ($folderId) {
            $params['folderid'] = $folderId;
        }

        return $this->request($params);
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
     * @param int $mediaAssetId
     * @return string
     */
    public function getMediaAssetDetails(int $mediaAssetId)
    {
        return $this->request(
            [
                'qt' => 'd',
                'maid' => $mediaAssetId
            ]
        );
    }

    /**
     * @param string $text
     * @return string
     */
    public function fullTextSearch(string $text)
    {
        return $this->request(['ftx' => $text]);
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
        return $this->formatOutput($content);
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

    /**
     * @param string $content
     * @return \SimpleXMLElement
     */
    private function convertContentToXml(string $content)
    {
        return simplexml_load_string($content, null, LIBXML_NOCDATA);
    }

    /**
     * @param string $content
     * @return string
     */
    private function convertContentToJson(string $content)
    {
        $xml = $this->convertContentToXml($content);
        return json_encode($xml);
    }

    /**
     * @param string $content
     * @return array
     */
    private function convertContentToArray(string $content)
    {
        $json = $this->convertContentToJson($content);
        return json_decode($json, true);
    }
}

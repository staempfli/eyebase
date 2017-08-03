<?php

namespace Staempfli\Eyebase;

use GuzzleHttp\Client;

class Api
{
    const DEFAULT_API_VERSION = 1;

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
     * @var array
     */
    private $defaultParams = [
        'fx' => 'api',
        'qt' => 'r'
    ];

    /**
     * Api constructor.
     * @param string $url
     * @param int $version
     */
    public function __construct(string $url = '', int $version = self::DEFAULT_API_VERSION)
    {
        $this->client = new Client();
        $this->setUrl($url);
        $this->setVersion($version);
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
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

    /**
     * @return string
     */
    public function getUrl()
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

    /**
     * @return string
     */
    public function getUsername()
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

    /**
     * @return string
     */
    public function getPassword()
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

    /**
     * @return string
     */
    public function getToken()
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

    /**
     * @param array $params
     */
    public function request(array $params =[])
    {
        $url = sprintf('%s/api/%d/webmill.php?%s',
            rtrim($this->getUrl(), '/'),
            $this->getVersion(),
            array_merge($this->getDefaultParams(), http_build_query($params))
        );

        $response = $this->client->get($url)->getBody();
        $test = 0;
    }

    /**
     * @return array
     */
    private function getDefaultParams()
    {
        $params = $this->defaultParams;
        $params['benutzer'] = $this->getUsername();
        $params['ben_kennung'] = $this->getPassword();
        $params['token'] = $this->getToken();
        return $params;
    }
}

<?php

namespace Staempfli\Eyebase;

abstract class Eyebase
{
    const DEFAULT_API_VERSION = 1;
    const DEFAULT_OUTPUT_FORMAT = 'xml';

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
     * @return string
     */
    public function getOutputFormat()
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
     * @return array
     */
    protected function getDefaultParams()
    {
        $params = $this->defaultParams;
        $params['benutzer'] = $this->getUsername();
        $params['ben_kennung'] = $this->getPassword();
        $params['token'] = $this->getToken();
        return array_filter($params);
    }
}

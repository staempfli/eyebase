<?php
/**
 * @copyright Copyright © 2017 Stämpfli AG. All rights reserved.
 * @author Marcel Hauri <marcel.hauri@staempfli.com>
 */
namespace Staempfli\Eyebase;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TooManyRedirectsException;
use Staempfli\Eyebase\Exception\InvalidXmlContentException;

/**
 * Class Eyebase
 * @package Staempfli\Eyebase
 */
abstract class Eyebase
{
    const DEFAULT_OUTPUT_FORMAT = 'xml';
    const MAX_REQUEST_ATTEMPTS = 5;

    /**
     * @var Client
     */
    private $client;
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
     * @var Logger
     */
    private $logger;
    /**
     * @var ContentConverter
     */
    private $contentConverter;
    /**
     * @var Validation
     */
    private $validation;
    /**
     * @var array
     */
    private $defaultParams = [
        'fx' => 'api',
        'qt' => 'r'
    ];
    /**
     * @var string
     */
    private $outputFormat = self::DEFAULT_OUTPUT_FORMAT;

    /**
     * Eyebase constructor.
     * @param string $url
     * @param string $token
     */
    public function __construct(string $url = '', string $token = '')
    {
        $this->client = new Client(['cookies' => true]);
        $this->logger = new Logger();
        $this->contentConverter = new ContentConverter();
        $this->validation = new Validation();
        $this->setUrl($url);
        $this->setToken($token);
    }

    public function getUrl() : string
    {
        return $this->url;
    }

    public function setUrl(string $url) : Eyebase
    {
        $this->url = $url;
        return $this;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function setUsername(string $username)  : Eyebase
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setPassword(string $password) : Eyebase
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
     * @throws \Exception
     */
    public function request(array $params = [])
    {
        $parameters = array_merge($this->getDefaultParams(), $params);
        $url = sprintf('%s/webmill.php?%s', rtrim($this->getUrl(), '/'), http_build_query($parameters));
        $requestAttempts = 0;
        $errors = [];
        do {
            try {
                $requestAttempts++;
                return $this->getRequestResult($url);
            } catch (\Exception $e) {
                if (!$this->apiClientNotAvailableException($e)) {
                    throw $e;
                }
                $message = sprintf("Error Request Url: %s\nMessage: %s", $url, $e->getMessage());
                $this->logger->error($e->getCode(), $message);
                $errors[] = $e->getMessage();
            }
        } while ($requestAttempts < self::MAX_REQUEST_ATTEMPTS);
        throw new \Exception(sprintf("Eyebase Request Failed with errors:\n%s", implode("\n", $errors)));
    }

    protected function getDefaultParams() : array
    {
        $params = $this->defaultParams;
        $params['benutzer'] = $this->getUsername();
        $params['ben_kennung'] = $this->getPassword();
        $params['token'] = $this->getToken();
        return array_filter($params);
    }

    private function apiClientNotAvailableException(\Exception $exception): bool
    {
        if ($exception instanceof InvalidXmlContentException) {
            return true;
        }
        if ($exception instanceof TooManyRedirectsException) {
            return true;
        }
        return false;
    }

    /**
     * @param string $url
     * @return array|\SimpleXMLElement|string
     */
    private function getRequestResult(string $url)
    {
        $response = $this->client->get($url);
        $content = $response->getBody()->getContents();
        $this->validation->validateResponse($response);
        $this->validation->validateContent($content);
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
                $output = $this->contentConverter->convertContentToXml($content);
                break;
            case 'json':
                $output = $this->contentConverter->convertContentToJson($content);
                break;
            case 'array':
                $output = $this->contentConverter->convertContentToArray($content);
                break;
            default:
                $output = $content;
                break;
        }
        return $output;
    }

}

<?php
/**
 * Validation
 *
 * @copyright Copyright © 2017 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Staempfli\Eyebase;

use Psr\Http\Message\ResponseInterface;
use Staempfli\Eyebase\Exception\EmptyFolderException;
use Staempfli\Eyebase\Exception\InvalidFolderException;
use Staempfli\Eyebase\Exception\InvalidResponseException;
use Staempfli\Eyebase\Exception\InvalidXmlContentException;
use Staempfli\Eyebase\Exception\LoginErrorException;

class Validation
{
    const ERROR_CODE_EMPTY_FOLDER = 260;
    const ERROR_CODE_INVALID_FOLDER = 290;
    const ERROR_CODE_LOGIN_ERROR = 300;

    /**
     * @var ContentConverter
     */
    private $contentConverter;

    public function __construct()
    {
        $this->contentConverter = new ContentConverter();
    }

    public function validateResponse(ResponseInterface $response)
    {
        if ($response->getReasonPhrase() !== 'OK') {
            throw new InvalidResponseException(sprintf('%s', $response->getReasonPhrase()));
        }
    }

    /**
     * @param string $content
     * @throws InvalidXmlContentException
     */
    public function validateContent(string $content)
    {
        if (false === @simplexml_load_string($content, null)) {
            throw new InvalidXmlContentException(
                sprintf("Error trying to convert following content to xml: %s", $content));
        }
        $xml = $this->contentConverter->convertContentToXml($content);
        if (isset($xml->error)) {
            $this->throwXmlContentErrorException($xml, $content);
        }
    }

    /**
     * @param $xml
     * @param string $content
     * @throws EmptyFolderException
     * @throws InvalidFolderException
     * @throws LoginErrorException
     * @throws \Exception
     */
    private function throwXmlContentErrorException($xml, string $content)
    {
        switch ((int) $xml->error->id) {
            case self::ERROR_CODE_EMPTY_FOLDER:
                throw new EmptyFolderException((string) $xml->error->message);
                break;
            case self::ERROR_CODE_INVALID_FOLDER:
                throw new InvalidFolderException((string) $xml->error->message);
                break;
            case self::ERROR_CODE_LOGIN_ERROR;
                throw new LoginErrorException((string) $xml->error->eyebase_message);
                break;
            default:
                throw new \Exception($this->contentConverter->convertContentToJson($content));
                break;
        }
    }
}

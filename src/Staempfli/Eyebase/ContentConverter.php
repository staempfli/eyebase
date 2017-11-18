<?php
/**
 * ContentConverter
 *
 * @copyright Copyright © 2017 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Staempfli\Eyebase;

class ContentConverter
{
    public function convertContentToArray(string $content) : array
    {
        $json = $this->convertContentToJson($content);
        return json_decode($json, true);
    }

    public function convertContentToJson(string $content) : string
    {
        $xml = $this->convertContentToXml($content);
        return json_encode($xml);
    }

    public function convertContentToXml(string $content) : \SimpleXMLElement
    {
        return simplexml_load_string($content, null, LIBXML_NOCDATA);
    }
}

<?php
/**
 * @copyright Copyright © 2017 Stämpfli AG. All rights reserved.
 * @author Marcel Hauri <marcel.hauri@staempfli.com>
 */
namespace Staempfli\Eyebase;

/**
 * Class Api
 * @package Staempfli\Eyebase
 */
class Api extends Eyebase
{
    /**
     * @return array|\SimpleXMLElement|string
     */
    public function getApiVersion()
    {
        return $this->request(['qt' => 'version']);
    }

    /**
     * @param string $username
     * @param string $password
     * @return array|\SimpleXMLElement|string
     */
    public function login(string $username, string $password)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        return $this->request(['qt' => 'login']);
    }

    /**
     * @return array|\SimpleXMLElement|string
     */
    public function getLoginStatus()
    {
        return $this->request(['qt' => 'loginstatus']);
    }

    /**
     * @return array|\SimpleXMLElement|string
     */
    public function getFolderTree()
    {
        $params = ['qt' => 'ftree'];

        return $this->request($params);
    }

    /**
     * @param int $folderId
     * @return array|\SimpleXMLElement|string
     */
    public function getKeyFolder(int $folderId = 0)
    {
        $params = ['qt' => 'r'];

        if ($folderId) {
            $params['keyfolder'] = $folderId;
        }

        return $this->request($params);
    }

    /**
     * @return array|\SimpleXMLElement|string
     */
    public function getAvailableLanguages()
    {
        return $this->request(['qt' => 'lang']);
    }

    /**
     * @return array|\SimpleXMLElement|string
     */
    public function getAvailableMediaAssetTypes()
    {
        return $this->request(['qt' => 'mat']);
    }

    /**
     * @param int $mediaAssetId
     * @return array|\SimpleXMLElement|string
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
     * @return array|\SimpleXMLElement|string
     */
    public function fullTextSearch(string $text)
    {
        return $this->request(['ftx' => $text]);
    }
}

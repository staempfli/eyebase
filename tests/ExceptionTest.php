<?php

use Staempfli\Eyebase\Exception\EmptyFolderException;
use Staempfli\Eyebase\Exception\InvalidResponseException;
use Staempfli\Eyebase\Exception\LoginErrorException;

class ExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testEmptyFolder()
    {
        $e = new EmptyFolderException('No media assets found matching your search criteria.');
        $this->assertSame('No media assets found matching your search criteria.', $e->getMessage());
    }

    public function testInvalidResponse()
    {
        $e = new InvalidResponseException('NOK');
        $this->assertSame('NOK', $e->getMessage());
    }

    public function testLoginError()
    {
        $e = new LoginErrorException('Benutzername oder Passwort ungueltig.');
        $this->assertSame('Benutzername oder Passwort ungueltig.', $e->getMessage());
    }
}

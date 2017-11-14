<?php
/**
 * Logger
 *
 * @copyright Copyright © 2017 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Staempfli\Eyebase;

class Logger
{
    private $logsPath;

    public function __construct()
    {
        $this->logsPath = __DIR__ . '/../../../log';
    }

    /**
     * @param mixin $code
     * @param string $message
     */
    public function error($code, string $message)
    {
        $errorLogFilename = $this->logsPath . '/error.log';
        $message = sprintf("[%s] Error with code: %s \n %s", date("d-m-Y h:i:s"), $code, $message);
        file_put_contents($errorLogFilename, $message, FILE_APPEND);
    }

}
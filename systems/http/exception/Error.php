<?php

namespace Kd\Http\Exception;

use ErrorException;
use Exception;

class Error
{

    private static $instance;

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Error handler. Convert all errors to Exception by throwing an ErrorException
     *
     * @param int $level Error level
     * @param string $message Error message
     * @param string $file Filename the error was raised in
     * @param int $line Line number in the file
     * @throws ErrorException
     */
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() != 0) {
            throw new ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Exception Handler
     *
     * @param Exception $exception
     *
     */
    public static function exceptionHandler($exception)
    {
        if ($exception instanceof Exception) {
            $data['message'] = $exception->getMessage();
            view()->renderFile(SYS_PATH . "Core/exceptions/resources/views",
                '500',
                $data);
            view()->show();
        }
    }

    public static function exceptionHandlerCommand($exception)
    {
        if ($exception instanceof Exception) {
            echo "Error: "  . $exception->getMessage(). PHP_EOL;
        }
    }
}

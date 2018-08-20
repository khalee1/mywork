<?php
/**
 * Created by PhpStorm.
 * User: lenguyenkha
 * Date: 8/15/18
 * Time: 10:57 PM
 */

namespace Kd\Core\Verify;


use Throwable;

class PostException extends \Exception
{
    function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
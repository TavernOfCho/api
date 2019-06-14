<?php


namespace App\Exception;

use Throwable;

class BattleNetException extends \Exception
{
    public function __construct($message = "An error occured with the Battle.net API", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

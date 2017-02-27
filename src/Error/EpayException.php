<?php

namespace Epay\Error;

use Exception;

class EpayException extends Exception
{
    protected $epayCode;

    public function __construct($message = '', $epayCode = null, $code = 0, Exception $previous = null)
    {
        $this->epayCode = $epayCode;

        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the epay code.
     *
     * @return null
     */
    public function getEpayCode()
    {
        return $this->epayCode;
    }
}

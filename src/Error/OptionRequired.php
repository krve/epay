<?php

namespace Epay\Error;

use Exception;

class OptionRequired extends Exception
{
    public function __construct($option)
    {
        $message = 'The "' . $option . '" key is required.';

        parent::__construct($message);
    }
}

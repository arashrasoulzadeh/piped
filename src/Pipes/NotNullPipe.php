<?php

namespace arashrasoulzadeh\piped\Pipes;

use arashrasoulzadeh\piped\Abstracts\Pipe;
use arashrasoulzadeh\piped\Exceptions\BreakPipeException;

class NotNullPipe extends Pipe
{
    public function command()
    {
        if (!isset($this->args[0])) {
            throw new BreakPipeException();
        }
        if (isset($this->args[0])) {
            if (is_null($this->args[0])) {
                throw new BreakPipeException();
            }
        }
        return $this->last_output;
    }
}

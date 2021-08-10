<?php

namespace arashrasoulzadeh\piped\Pipes;

use arashrasoulzadeh\piped\Abstracts\Pipe;
use arashrasoulzadeh\piped\Exceptions\BreakPipeException;

/**
 * Sum all items in args array
 */
class SumAllPipe extends Pipe
{
    public function command()
    {
        $this->last_output = 0;
        foreach ($this->args as $arg) {
            if (!is_numeric($arg)) {
                throw new BreakPipeException();
            }
            $this->last_output += $arg;
        }
        return $this->last_output;
    }
}

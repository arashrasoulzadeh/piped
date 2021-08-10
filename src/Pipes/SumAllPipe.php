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
        $should_brake_if_null = $this->pickArg($this->custom_args[0]); // send true/false
        if (is_null($should_brake_if_null)) {
            $should_brake_if_null = true;
        }
        foreach ($this->args as $arg) {
            if (!is_numeric($arg)) {
                if ($should_brake_if_null) {
                    throw new BreakPipeException();
                }
            } else {
                $this->last_output += $arg;
            }
        }
        return $this->last_output;
    }
}

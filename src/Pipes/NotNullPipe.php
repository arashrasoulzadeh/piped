<?php

namespace arashrasoulzadeh\piped\Pipes;

use arashrasoulzadeh\piped\Abstracts\Pipe;
use arashrasoulzadeh\piped\Exceptions\BreakPipeException;

class NotNullPipe extends Pipe
{
    public function command()
    {
        $indexes = $this->pickArg($this->custom_args[0]);
        if (is_null($indexes)) {
            $this->checkIndex(0);
        } else {
            if (is_array($indexes)) {
                foreach ($indexes as $index) {
                    $this->checkIndex($index);
                }
            }
            if ($indexes === '*') {
                foreach ($this->args as $arguman) {
                    if (is_null($arguman)) {
                        throw new BreakPipeException();
                    }
                }
            }
        }
        return $this->last_output;
    }

    public function checkIndex($index)
    {
        if (!isset($this->args[$index])) {
            throw new BreakPipeException();
        }
        if (isset($this->args[$index])) {
            if (is_null($this->args[$index])) {
                throw new BreakPipeException();
            }
        }
    }
}

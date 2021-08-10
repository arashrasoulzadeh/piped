<?php

namespace arashrasoulzadeh\piped\Pipes;

use arashrasoulzadeh\piped\Abstracts\Pipe;

/**
 * Sum all items in args array
 */
class ConcatAllPipe extends Pipe
{
    public function command()
    {
        $custom_seperator = $this->pickArg($this->custom_args[0]);
        $seperator = is_null($custom_seperator) ? " " : $custom_seperator;
        $this->args = array_filter($this->args);
        return implode($seperator, $this->args);
    }
}

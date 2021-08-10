<?php

namespace arashrasoulzadeh\piped\Pipes;

use arashrasoulzadeh\piped\Abstracts\Pipe;
use Exception;
use Throwable;

/**
 * Sum all items in args array
 */
class MapPipe extends Pipe
{

    public function command()
    {

        $annonymous_function = $this->pickArg($this->custom_args[0]);
        if (is_null($annonymous_function)) {
            return $this->last_output;
        }
        if (is_array($this->last_output)) {
            for ($i = 0; $i < count($this->last_output); $i++) {
                $this->last_output[$i] = $this->invoke(
                    $this->last_output[$i],
                    $annonymous_function,
                    $i
                );
            }
        } else {
            $this->last_output = $this->invoke(
                $this->last_output,
                $annonymous_function,
                0
            );
        }
        return $this->last_output;
    }
    /**
     * invoke the function
     *
     * @param array $item
     * @param Closure $function
     * @param int $i
     * @return void
     */
    private function invoke($item, $function, $i)
    {
        return $function($item, $i);
    }
}

<?php

namespace arashrasoulzadeh\piped;

use App\Console\Commands\Pipe;
use arashrasoulzadeh\piped\Exceptions\BreakPipeException;
use Closure;
use Exception;
use Throwable;

class Piped
{
    private $args = [];
    private $output = null;
    /**
     * create new instance
     *
     * @return void
     */
    public static function build(): Piped
    {
        return new Piped();
    }
    /**
     * run args through pipes
     *
     * @param  array $pipes
     * @return Piped
     */
    public function through(...$pipes): Piped
    {
        $this->output = $this->args;

        foreach ($pipes as $pipe) {
            try {
                if ($pipe instanceof Closure) {
                    $this->output = $pipe($this->output, $this->args);
                } else if (is_array($pipe)) {
                    $pipe = (new $pipe[0]($this->output, $this->args, array_slice($pipe, 1)));
                    $this->output = $pipe->handle();
                } else {
                    $pipe = (new $pipe($this->output, $this->args));
                    $this->output = $pipe->handle();
                }
            } catch (Exception | Throwable $e) {
                if ($e instanceof BreakPipeException) {
                    return $this;
                }
                throw $e;
            }
        }
        return $this;
    }

    public function pipe(...$args): Piped
    {
        $this->args = $args;
        return $this;
    }
    public function output()
    {
        return $this->output;
    }
}

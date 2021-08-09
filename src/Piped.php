<?php

namespace arashrasoulzadeh\piped;

use Closure;

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
        foreach ($pipes as $pipe) {
            if ($pipe instanceof Closure) {
                $this->output = $pipe($this->output, $this->args);
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
        return $this->output();
    }
}

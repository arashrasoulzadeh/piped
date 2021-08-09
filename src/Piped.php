<?php

namespace arashrasoulzadeh\piped;

class Piped
{
    private $args;
    private $output;
    /**
     * create new instance
     *
     * @return void
     */
    public static function build(): Piped
    {
        return new Piped();
    }

    public function through(): Piped
    {

        return $this;
    }

    public function pipe(...$args): Piped
    {
        $this->args = $args;
        return $this;
    }
    public function output(): mixed
    {
        return $this->output();
    }
}

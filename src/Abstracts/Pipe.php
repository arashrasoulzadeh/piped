<?php

namespace arashrasoulzadeh\piped\Abstracts;

use arashrasoulzadeh\piped\Exceptions\BreakPipeException;
use Closure;
use Exception;
use Throwable;

class Pipe
{
    protected $args = [];
    protected $last_output;
    protected $rollback = true;
    protected $throw_error = false;
    protected $custom_args;

    public function __construct($last_output, array $args, $custom_args = null)
    {
        $this->last_output = $last_output;
        $this->args = $args;
        $this->custom_args = $custom_args;
    }
    /**
     * pipe command
     *
     * @return mixed
     */
    public function command()
    {
        return 0;
    }
    /**
     * handle the execution and failure of pipe
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            return $this->command();
        } catch (Exception | Throwable $e) {
            if ($e instanceof BreakPipeException) {
                throw $e;
            } else {
                if ($this->rollback) {
                    return $this->last_output;
                } else {
                    if ($this->throw_error) {
                        throw $e;
                    } else {
                        throw new Exception("error running pipe " . get_class($this));
                    }
                }
            }
        }
    }
    /**
     * automaticaly pick a valid argument from a list of arguments
     *
     * @param array ...$vars
     * @return mixed
     */
    public function pickArg(&...$vars)
    {
        foreach ($vars as $var) {
            if (isset($var))
                return $var;
        }
        return null;
    }
}

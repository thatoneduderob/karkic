<?php

namespace Violin\Rules;

use Violin\Contracts\RuleContract;

class AlnumDashRule implements RuleContract
{
    public function run($value, $input, $args)
    {
        // /^[\pL\pM\pN_-]+$/u
        return (bool) preg_match('/^[a-z0-9\040\,\-]+$/i', $value);
    }

    public function error()
    {
        return '{field} must be alphanumeric with dashes and underscores permitted.';
    }

    public function canSkip()
    {
        return true;
    }
}

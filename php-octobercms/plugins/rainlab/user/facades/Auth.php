<?php namespace RainLab\User\Facades;

use October\Rain\Support\Facade;

class Auth extends Facade
{
    /**
     * Get the registered name of the component.
     * @return string
     */
    protected static function getFacadeAccessor() { return 'user.auth'; }
}

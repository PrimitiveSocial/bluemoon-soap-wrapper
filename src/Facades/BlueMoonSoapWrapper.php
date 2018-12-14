<?php

namespace PrimitiveSocial\BlueMoonSoapWrapper\Facades;

use Illuminate\Support\Facades\Facade;

class BlueMoonSoapWrapper extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bluemoonsoapwrapper';
    }
}

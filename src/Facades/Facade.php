<?php

namespace Javfres\Slack\Facades;

class Slack extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'javfres.slack';
    }
}

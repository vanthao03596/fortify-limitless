<?php

namespace Vanthao03596\FortifyLimitless;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Vanthao03596\FortifyLimitless\FortifyLimitless
 */
class FortifyLimitlessFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fortify-limitless';
    }
}

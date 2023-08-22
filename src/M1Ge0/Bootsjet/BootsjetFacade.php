<?php

namespace M1ge0\Bootsjet;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Bootsjet bootstrap4()
 * @method static Bootsjet bootstrap5()
 * @method static bool isBootstrap4()
 * @method static bool isBootstrap5()
 * @method static Bootsjet useCoreUi3()
 * @method static Bootsjet useAdminLte3()
 * @method static false|string getPreset()
 *
 * @see Bootsjet
 */
class BootsjetFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bootsjet';
    }
}
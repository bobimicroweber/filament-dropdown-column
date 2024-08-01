<?php

namespace BobiMicroweber\FilamentDropdownColumn\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \BobiMicroweber\FilamentDropdownColumn\FilamentDropdownColumn
 */
class FilamentDropdownColumn extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \BobiMicroweber\FilamentDropdownColumn\FilamentDropdownColumn::class;
    }
}

<?php

namespace BobiMicroweber\FilamentDropdownColumn\Columns;

use Closure;
use Filament\Actions\Concerns\HasSize;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\CanBeValidated;
use Filament\Tables\Columns\Concerns\CanUpdateState;
use Filament\Tables\Columns\Concerns\HasColor;
use Filament\Tables\Columns\Concerns\HasIcon;
use Filament\Tables\Columns\Contracts\Editable;
use Filament\Tables\Filters\Concerns\HasOptions;

class DropdownColumn extends Column
{
    use CanUpdateState;
    use HasIcon;
    use HasSize;
    use HasOptions;
    use HasColor;

    protected string $view = 'filament-dropdown-column::columns.dropdown-column';

    protected function setUp(): void
    {
        parent::setUp();

        $this->disabledClick();

    }

}

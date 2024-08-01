<?php

namespace BobiMicroweber\FilamentDropdownColumn\Columns;

use Filament\Actions\Concerns\HasSize;
use Filament\Forms\Components\Concerns\CanDisableOptions;
use Filament\Forms\Components\Concerns\CanSelectPlaceholder;
use Filament\Forms\Components\Concerns\HasExtraInputAttributes;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\Concerns\CanBeValidated;
use Filament\Tables\Columns\Concerns\CanUpdateState;
use Filament\Tables\Columns\Concerns\HasColor;
use Filament\Tables\Columns\Concerns\HasIcon;
use Filament\Tables\Columns\Contracts\Editable;
use Filament\Tables\Filters\Concerns\HasOptions;

class DropdownColumn extends Column implements Editable
{

    use CanBeValidated;
    use CanUpdateState;

    use HasColor;
    use HasIcon;
    use HasOptions;
    use HasSize;

    protected string $view = 'filament-dropdown-column::columns.dropdown-column';

    protected function setUp(): void
    {
        parent::setUp();

        $this->disabledClick();

    }
}

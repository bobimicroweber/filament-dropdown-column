<?php

namespace BobiMicroweber\FilamentDropdownColumn\Commands;

use Illuminate\Console\Command;

class FilamentDropdownColumnCommand extends Command
{
    public $signature = 'filament-dropdown-column';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}

<?php

namespace BobiMicroweber\FilamentDropdownColumn\Columns\Concerns;

use BobiMicroweber\FilamentDropdownColumn\Enums\ButtonSize;
use Closure;

trait HasSize
{
    protected ButtonSize | string | Closure | null $defaultSize = null;

    protected ButtonSize | string | Closure | null $size = null;

    public function defaultSize(ButtonSize | string | Closure | null $size): static
    {
        $this->defaultSize = $size;

        return $this;
    }

    public function size(ButtonSize | string | Closure | null $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getDefaultSize(): ButtonSize | string | null
    {
        return $this->evaluate($this->defaultSize);
    }

    public function getSize(): ButtonSize | string | null
    {
        return $this->evaluate($this->size) ?? $this->getDefaultSize();
    }
}

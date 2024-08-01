@php
    $state = $getState();
    if ($state instanceof \BackedEnum) {
        $state = $state->value;
    }
    $state = strval($state);

    $options = $getOptions();
    $size =  $getSize() ?? \BobiMicroweber\FilamentDropdownColumn\Enums\ButtonSize::Small;
    $color = $getColor($state) ?? 'gray';

@endphp

<div
    wire:key="{{ $this->getId() }}.table.record.{{ $recordKey }}.column.{{ $getName() }}.toggle-column.{{ $state ? 'true' : 'false' }}"
>


    <div
        x-data="{
            error: undefined,

            isLoading: false,

            name: @js($getName()),

            recordKey: @js($recordKey),

            state: @js($state),
        }"

        {{
   $attributes
       ->merge($getExtraAttributes(), escape: false)
       ->class([
           'fi-ta-dropdown',
           'px-3 py-4' => ! $isInline(),
       ])
}}
    >


        <x-filament::dropdown placement="bottom-end">
            <x-slot name="trigger">


                <x-filament::button :size="$size" :color="$color">

                    <div class="flex gap-2 items-center">

                        @if ($icon = $getIcon($state))
                            @php
                                $size = $getSize($state) ?? \Filament\Tables\Columns\IconColumn\IconColumnSize::Large;
                                $iconColor = 'white';
                            @endphp

                            <x-filament::icon
                                :icon="$icon"
                                @class([
                                    'fi-ta-icon-item',
                                    match ($size) {
                                        \Filament\Tables\Columns\IconColumn\IconColumnSize::ExtraSmall, 'xs' => 'fi-ta-icon-item-size-xs h-3 w-3',
                                        \Filament\Tables\Columns\IconColumn\IconColumnSize::Small, 'sm' => 'fi-ta-icon-item-size-sm h-4 w-4',
                                        \Filament\Tables\Columns\IconColumn\IconColumnSize::Medium, 'md' => 'fi-ta-icon-item-size-md h-5 w-5',
                                        \Filament\Tables\Columns\IconColumn\IconColumnSize::Large, 'lg' => 'fi-ta-icon-item-size-lg h-6 w-6',
                                        \Filament\Tables\Columns\IconColumn\IconColumnSize::ExtraLarge, 'xl' => 'fi-ta-icon-item-size-xl h-7 w-7',
                                        \Filament\Tables\Columns\IconColumn\IconColumnSize::TwoExtraLarge, \Filament\Tables\Columns\IconColumn\IconColumnSize::ExtraExtraLarge, '2xl' => 'fi-ta-icon-item-size-2xl h-8 w-8',
                                        default => $size,
                                    },
                                    match ($iconColor) {
                                        'gray' => 'text-gray-400 dark:text-gray-500',
                                        default => 'fi-color-custom text-custom-500 dark:text-custom-400',
                                    },
                                    is_string($iconColor) ? 'fi-color-' . $iconColor : null,
                                ])
                                @style([
                                    \Filament\Support\get_color_css_variables(
                                        $iconColor,
                                        shades: [400, 500],
                                        alias: 'tables::columns.icon-column.item',
                                    ) => $iconColor !== 'gray',
                                ])
                            />
                        @endif

                        @if(isset($options[$state]))
                            {{ $options[$state] }}
                        @else
                            Unknown
                        @endif

                        <x-filament::icon icon="heroicon-o-chevron-down" class="w-5 h-5"/>

                    </div>
                </x-filament::button>


            </x-slot>

            <x-filament::dropdown.list>
                @foreach($options as $optionKey => $optionValue)
                    @php
                        $optionIcon = $getIcon($optionKey);
                    @endphp
                    <x-filament::dropdown.list.item

                        x-data="{
                           currentOptionKey: '{{ $optionKey }}'
                        }"

                        x-tooltip="error"
                        x-bind:class="{
                            'opacity-50 pointer-events-none': isLoading,
                        }"
                        x-on:click="async () => {

                             isLoading = true

                            const response = await $wire.updateTableColumnState(
                                name,
                                recordKey,
                               currentOptionKey,
                            )

                            error = response?.error ?? undefined

                            if (! error) {
                                state = response
                            }

                            isLoading = false

                           close();

                        }"
                        :icon="$optionIcon"
                    >
                        {{ $optionValue }}
                    </x-filament::dropdown.list.item>
                @endforeach
            </x-filament::dropdown.list>

        </x-filament::dropdown>

    </div>

</div>

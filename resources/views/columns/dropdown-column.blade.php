@php
    use Filament\Tables\Columns\IconColumn\IconColumnSize;

    $arrayState = $stateString = $getState();

    if ($arrayState instanceof \Illuminate\Support\Collection) {
        $arrayState = $arrayState->all();
    }

    $arrayState = \Illuminate\Support\Arr::wrap($arrayState);

    $options = $getOptions();
    if ($stateString instanceof \BackedEnum) {
        $stateString = $stateString->value;
    }
    $stateString = strval($stateString);
@endphp

<div
    wire:key="{{ $this->getId() }}.table.record.{{ $recordKey }}.column.{{ $getName() }}.toggle-column.{{ $state ? 'true' : 'false' }}"
>

    @if (count($arrayState))

        <div
            x-data="{
            error: undefined,

            isLoading: false,

            name: @js($getName()),

            recordKey: @js($recordKey),

            state: @js($stateString),
        }"
    "

        {{
   $attributes
       ->merge($getExtraAttributes(), escape: false)
       ->class([
           'fi-ta-dropdown',
           'px-3 py-4' => ! $isInline(),
       ])
}}
    >



        <x-filament::dropdown

        >
            <x-slot name="trigger">


                @foreach ($arrayState as $state)
                    @if ($icon = $getIcon($state))
                        @php
                            $color = $getColor($state) ?? 'gray';
                            $size = $getSize($state) ?? IconColumnSize::Large;
                            $iconColor = 'white';
                        @endphp

                        <x-filament::button :color="$color">

                            <div class="flex gap-2 items-center">
                                <x-filament::icon
                                    :icon="$icon"
                                    @class([
                                        'fi-ta-icon-item',
                                        match ($size) {
                                            IconColumnSize::ExtraSmall, 'xs' => 'fi-ta-icon-item-size-xs h-3 w-3',
                                            IconColumnSize::Small, 'sm' => 'fi-ta-icon-item-size-sm h-4 w-4',
                                            IconColumnSize::Medium, 'md' => 'fi-ta-icon-item-size-md h-5 w-5',
                                            IconColumnSize::Large, 'lg' => 'fi-ta-icon-item-size-lg h-6 w-6',
                                            IconColumnSize::ExtraLarge, 'xl' => 'fi-ta-icon-item-size-xl h-7 w-7',
                                            IconColumnSize::TwoExtraLarge, IconColumnSize::ExtraExtraLarge, '2xl' => 'fi-ta-icon-item-size-2xl h-8 w-8',
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

                                @if(isset($options[$stateString]))
                                    {{ $options[$stateString] }}
                                @else
                                    Unknown
                                @endif

                                <x-filament::icon icon="heroicon-o-chevron-down" class="w-5 h-5"/>

                            </div>
                        </x-filament::button>

                    @endif
                @endforeach


            </x-slot>

            <x-filament::dropdown.list

                placement="bottom-end"

            >
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

    @elseif (($placeholder = $getPlaceholder()) !== null)
        <x-filament-tables::columns.placeholder>
            {{ $placeholder }}
        </x-filament-tables::columns.placeholder>
    @endif

</div>

# Filament Dropdown Column

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bobimicroweber/filament-dropdown-column.svg?style=flat-square)](https://packagist.org/packages/bobimicroweber/filament-dropdown-column)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/bobimicroweber/filament-dropdown-column/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bobimicroweber/filament-dropdown-column/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bobimicroweber/filament-dropdown-column.svg?style=flat-square)](https://packagist.org/packages/bobimicroweber/filament-dropdown-column)

![banner](resources/assets/banner.jpg)

## Installation

You can install the package via composer:

```bash
composer require bobimicroweber/filament-dropdown-column
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-dropdown-column-views"
```

## Usage

Simple
```php
DropdownColumn::make('is_active')
    ->size('sm')
    ->options([
    1 => 'Published',
    0 => 'Unpublished',
])
```

Advanced with icons and colors
```php
DropdownColumn::make('is_active')
    ->size('sm')
    ->options([
        1 => 'Published',
        0 => 'Unpublished',
    ])
    ->icon(fn (string $state): string => match ($state) {
        '0' => 'heroicon-o-clock',
        '1' => 'heroicon-o-check',
        default => 'heroicon-o-clock',
    })
    ->color(fn (string $state): string => match ($state) {
        '0' => 'warning',
        '1' => 'success',
        default => 'gray',
    }),
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Bozhidar Slaveykov](https://github.com/bobimicroweber)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

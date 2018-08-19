# Extract billing data from text

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

This package provides an easy way to extract billing data from text. We use it in our German SaaS product [einfachArchiv](https://www.einfacharchiv.com).

## Requirements

PHP 7.0 and later.

## Installation

You can install this package via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require einfacharchiv/extractor
```

## Usage

Extracting billing data is easy.

```php
$text = <<<EOT
Rechnungsnummer: 4711
Rechnungsdatum: 20.11.2077
Rechnungsbetrag: 119,00 €
...
EOT;

// Pass the text and the locales (the methods return the values in the same order)
$extractor = new \einfachArchiv\Extractor\Extractor($text, ['de', 'en']);

// Available methods
$extractor->findAmounts();
$extractor->findBics();
$extractor->findCompanyNames();
$extractor->findCompanyRegisterIds();
$extractor->findCustomerIds();
$extractor->findDates();
$extractor->findEmails();
$extractor->findIbans();
$extractor->findInvoiceIds();
$extractor->findPaymentReferences();
$extractor->findTaxNumbers();
$extractor->findTypes();
$extractor->findVatNumbers();
$extractor->findWebsites();
```

If no matches were found, the methods return an empty array.

The method `->findAmounts()` returns an array like this one:

```php
[
    [
        'amount' => 119,
        'currency' => 'EUR',
    ],
    ...
];
```

All amounts are returned as `floats`.

The method `->findCompanyRegisterIds()` returns an array like this one:

```php
[
    [
        'area' => 'HRB',
        'number' => '123456',
        'office' => 'Stuttgart',
    ],
    ...
];
```

The invoice date is, if present, a valid date and can be used like this:

```php
$dates = $extractor->findDates();

\Carbon\Carbon::parse($dates[0])->toDateString();
```

The method `->findTaxNumbers()` returns an array like this one:

```php
[
    [
        'number' => '12345/67890',
        'state' => 'BW',
    ],
    ...
];
```

The method `->findTypes()` returns the following types:

```php
[
    'invoice',
    'credit-note',
    'reminder',
    'salary-statement',
    'bank-statement',
    'contract',
    'balance-sheet',
    'tax-assessment-note',
];
```

## Contributing
Contributions are **welcome**.

We accept contributions via Pull Requests on [Github](https://github.com/einfachArchiv/extractor).

Find yourself stuck using the package? Found a bug? Do you have general questions or suggestions for improvement? Feel free to [create an issue on GitHub](https://github.com/einfachArchiv/extractor/issues), we'll try to address it as soon as possible.

If you've found a security issue, please email [support@einfacharchiv.com](mailto:support@einfacharchiv.com) instead of using the issue tracker.

**Happy coding**!

## Credits

- [Philip Günther](https://github.com/Pag-Man)
- [All Contributors](https://github.com/einfachArchiv/extractor/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

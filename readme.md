[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

# VAT  
A package for validating EU VAT numbers, checking their format and existence.
## List of available clients 
- ✔ VIES

## Installation
This package can be installed via composer:
```console
$ composer require bolivir/vat
```

## How to use
### Validate the format
The method `validateFormat` will check the format for a given VAT number. It will not check the existence!  
Example:
```php
$VAT = new \Bolivir\Vat\Vat();
echo $VAT->validateFormat('FR12345678901'); // It will check the COUNTRY + FORMAT AND NOT REAL EXISTENCE!
```

# Change log
Please see CHANGELOG for more information on what has been changed recently.

# Security
If you discover any security related issues, please email mosselmanricardo@gmail.com instead of using the issue tracker.

# Credits
- [Bolivir](https://github.com/bolivir)
- [All Contributors](https://github.com/bolivir/multipay/graphs/contributors)

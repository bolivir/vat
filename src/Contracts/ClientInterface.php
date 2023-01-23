<?php

namespace Bolivir\Vat\Contracts;

use Bolivir\Vat\VatValidationResponse;

interface ClientInterface
{
    public function validate(string $countryCode, string $vatNumber): VatValidationResponse;
}

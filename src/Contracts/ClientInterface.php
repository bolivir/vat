<?php

namespace Bolivir\Vat\Contracts;

interface ClientInterface
{
    public function validate(string $countryCode, string $vatNumber): bool;
}

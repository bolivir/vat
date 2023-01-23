<?php

namespace Bolivir\Vat;

class VatFormatValidationResponse
{
    public function __construct(
        private readonly string $countryCode = '',
        private readonly string $vatNumber = '',
        private readonly bool $valid = false
    ) {
    }

    public function countryCode(): string
    {
        return $this->countryCode;
    }

    public function vatNumber(): string
    {
        return $this->vatNumber;
    }

    public function isValid(): bool
    {
        return $this->valid;
    }
}

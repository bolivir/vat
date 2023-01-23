<?php

namespace Bolivir\Vat;

class VatValidationResponse
{
    public function __construct(
        private readonly string $countryCode,
        private readonly string $vatNumber,
        private readonly string $requestDate,
        private readonly bool $valid,
        private readonly string $name,
        private readonly string $address
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

    public function requestDate(): string
    {
        return $this->requestDate;
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function address(): string
    {
        return $this->address;
    }
}

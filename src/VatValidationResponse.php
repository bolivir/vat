<?php

/*
 * This file is part of the bolivir/vat project.
 * (c) Ricardo Mosselman <mosselmanricardo@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

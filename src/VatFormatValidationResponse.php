<?php

/*
 * This file is part of the bolivir/vat project.
 * (c) Ricardo Mosselman <mosselmanricardo@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

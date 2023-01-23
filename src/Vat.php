<?php

/*
 * This file is part of the bolivir/vat project.
 * (c) Ricardo Mosselman <mosselmanricardo@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bolivir\Vat;

use Bolivir\Vat\Abstracts\Client;
use Bolivir\Vat\Clients\VIES\VIES;

class Vat
{
    private Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?: new VIES();
    }

    public function validate(string $vatNumber): VatValidationResponse
    {
        $this->validateFormat($vatNumber);

        list($country, $number) = $this->splitVAT($vatNumber);
        $number = $this->formatVAT($number);

        return $this->client->validate($country, $number);
    }

    public function validateFormat(string $vatNumber): VatFormatValidationResponse
    {
        if (empty($vatNumber)) {
            return new VatFormatValidationResponse();
        }

        list($country, $number) = $this->splitVAT($vatNumber);
        $number = $this->formatVAT($number);

        if (!isset(CountriesRegularExpressions::$patterns[$country])) {
            return new VatFormatValidationResponse($country, $number, false);
        }

        return new VatFormatValidationResponse(
            $country,
            $number,
            preg_match('/^'.CountriesRegularExpressions::$patterns[$country].'$/', $number) > 0
        );
    }

    private function formatVAT(string $vatNumber): string
    {
        return strtoupper(trim($vatNumber));
    }

    /** @return array{string,string}. */
    private function splitVAT(string $vatNumber): array
    {
        return [
            substr($vatNumber, 0, 2),
            substr($vatNumber, 2),
        ];
    }
}

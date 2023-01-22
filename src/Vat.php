<?php

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

    public function validateFormat(string $vatNumber): bool
    {
        if (empty($vatNumber)) {
            return false;
        }

        list($country, $number) = $this->splitVAT($vatNumber);
        $number = $this->formatVAT($number);

        if (!isset(CountriesRegularExpressions::$patterns[$country])) {
            return false;
        }

        return preg_match('/^'.CountriesRegularExpressions::$patterns[$country].'$/', $number) > 0;
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

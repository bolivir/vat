<?php

namespace Bolivir\Vat\Clients\VIES;

use Bolivir\Vat\Abstracts\Client;

class VIES extends Client
{
    public function validate(string $countryCode, string $vatNumber): bool
    {
        // TODO: Implement validate() method.
        return true;
    }
}

<?php

namespace Bolivir\Vat\Clients\VIES;

use Bolivir\Vat\Abstracts\Client;
use Bolivir\Vat\VatValidationResponse;
use SoapClient;
use SoapFault;
use stdClass;

class VIES extends Client
{
    private string $baseUrl = 'https://ec.europa.eu';

    private string $wsdlEndpoint = '/taxation_customs/vies/checkVatService.wsdl';

    private SoapClient $client;

    public function __construct(private readonly int $timeout = 10)
    {
        $this->client = new SoapClient(
            "{$this->baseUrl}{$this->wsdlEndpoint}",
            ['connection_timeout' => $this->timeout]
        );
    }

    public function validate(string $countryCode, string $vatNumber): VatValidationResponse
    {
        try {
            $response = $this->client->checkVat(
                [
                    'countryCode' => $countryCode,
                    'vatNumber' => $vatNumber,
                ]
            );

            return $this->transformResponse($response);
        } catch (SoapFault $e) {
            throw new ViesException($e->getMessage(), $e->getCode());
        }
    }

    private function transformResponse(stdClass $response): VatValidationResponse
    {
        return new VatValidationResponse(
            $response->countryCode,
            $response->vatNumber,
            $response->requestDate,
            $response->valid,
            $response->name,
            $response->address
        );
    }
}

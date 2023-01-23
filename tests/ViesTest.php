<?php

namespace Bolivir\Vat\Tests;

use Bolivir\Vat\Clients\VIES\VIES;
use Bolivir\Vat\VatValidationResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use SoapClient;
use stdClass;

/**
 * @internal
 */
class ViesTest extends TestCase
{
    /** @test */
    public function it_can_validate_valid_vat_number_and_transform_response(): void
    {
        $vies = new VIES();
        $soapMock = $this->createPartialMock(SoapClient::class, ['__call']);
        $soapMock->method('__call')->willReturn($this->validResponse('NL', '123456789B12'));

        $this->setPrivateProperty($vies, 'client', $soapMock);
        $response = $vies->validate('NL', '123456789B12');

        $this->assertInstanceOf(VatValidationResponse::class, $response);
        $this->assertSame('NL', $response->countryCode());
        $this->assertSame('123456789B12', $response->vatNumber());
        $this->assertSame('01-01-1970', $response->requestDate());
        $this->assertTrue($response->isValid());
        $this->assertEmpty($response->name());
        $this->assertEmpty($response->address());
    }

    /** @test */
    public function it_can_validate_invalid_vat_number_and_transform_response(): void
    {
        $vies = new VIES();
        $soapMock = $this->createPartialMock(SoapClient::class, ['__call']);
        $soapMock->method('__call')->willReturn($this->invalidResponse());

        $this->setPrivateProperty($vies, 'client', $soapMock);
        $response = $vies->validate('xx', 'xxxxx');

        $this->assertInstanceOf(VatValidationResponse::class, $response);
        $this->assertEmpty($response->countryCode());
        $this->assertEmpty($response->vatNumber());
        $this->assertSame('01-01-1970', $response->requestDate());
        $this->assertFalse($response->isValid());
        $this->assertEmpty($response->name());
        $this->assertEmpty($response->address());
    }

    /**
     * @param mixed $obj
     * @param mixed $value
     */
    protected function setPrivateProperty($obj, string $propertyName, $value): void
    {
        $reflection = new ReflectionClass($obj);
        $reflection_property = $reflection->getProperty($propertyName);
        $reflection_property->setAccessible(true);

        $reflection_property->setValue($obj, $value);
    }

    private function validResponse(string $countryCode, string $vatNumber): stdClass
    {
        $res = new stdClass();
        $res->countryCode = $countryCode;
        $res->vatNumber = $vatNumber;
        $res->requestDate = '01-01-1970';
        $res->valid = true;
        $res->name = '';
        $res->address = '';

        return $res;
    }

    private function invalidResponse(): stdClass
    {
        $res = new stdClass();
        $res->countryCode = '';
        $res->vatNumber = '';
        $res->requestDate = '01-01-1970';
        $res->valid = false;
        $res->name = '';
        $res->address = '';

        return $res;
    }
}

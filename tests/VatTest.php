<?php

namespace Bolivir\Vat\Tests;

use Bolivir\Vat\Vat;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class VatTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider validVatFormatsDataProvider
     *
     * @param array<string> $validVatNumbers
     */
    public function it_can_validate_valid_formats_correctly(array $validVatNumbers): void
    {
        $vat = new Vat();
        foreach ($validVatNumbers as $vatNumber) {
            $result = $vat->validateFormat($vatNumber);
            $this->assertTrue($result->isValid(), "{$vatNumber} did not pass and should have passed!");
            $this->assertSame(substr($vatNumber, 0, 2), $result->countryCode());
            $this->assertSame(substr($vatNumber, 2), $result->vatNumber());
        }
    }

    /**
     * @test
     *
     * @param array<string> $invalidVatNumbers
     *
     * @dataProvider invalidVatFormatsDataProvider
     */
    public function it_can_validate_invalid_formats_correctly(array $invalidVatNumbers): void
    {
        $vat = new Vat();
        foreach ($invalidVatNumbers as $vatNumber) {
            $result = $vat->validateFormat($vatNumber);
            $this->assertFalse($result->isValid(), "{$vatNumber} did pass and should not pass!");
        }
    }

    /**
     * @return array<int, array<int, array<int, string>>>
     */
    public function validVatFormatsDataProvider(): array
    {
        return [
            [['ATU12345678',
                'BE0123456789',
                'BE1234567891',
                'BG123456789',
                'BG1234567890',
                'CY12345678X',
                'CZ12345678',
                'DE123456789',
                'DK12345678',
                'EE123456789',
                'EL123456789',
                'ESX12345678',
                'FI12345678',
                'FR12345678901',
                'FRA2345678901',
                'FRAB345678901',
                'FR1B345678901',
                'GB999999973',
                'HU12345678',
                'HR12345678901',
                'IE1234567X',
                'IT12345678901',
                'LT123456789',
                'LU12345678',
                'LV12345678901',
                'MT12345678',
                'NL123456789B12',
                'PL1234567890',
                'PT123456789',
                'RO123456789']],
        ];
    }

    /**
     * @return array<int, array<int, array<int, string>>>
     */
    public function invalidVatFormatsDataProvider(): array
    {
        return [
            [['',
                'ATU1234567',
                'BE012345678',
                'BE123456789',
                'BG1234567',
                'CY1234567X',
                'CZ1234567',
                'DE12345678',
                'PREFIX_NL12345678B12',
                'NL12345678B12_SUFFIX', ]],
        ];
    }
}

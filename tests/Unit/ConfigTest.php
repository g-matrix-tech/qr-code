<?php

declare(strict_types=1);

namespace Tests\Unit;

use GMatrixTech\QrCode\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testConfigIsArray()
    {
        $config = (
            new Config()
        )
            ->value();

        $this->assertIsArray($config);
    }

    public function testConfigHasKeys()
    {
        $config = (
            new Config()
        )
            ->value();

        $this->assertArrayHasKey('qr_code_reader_path', $config);
    }

    public function testCountOfConfigKeys()
    {
        $config = (
            new Config()
        )
            ->value();

        $this->assertCount(1, $config);
    }
}

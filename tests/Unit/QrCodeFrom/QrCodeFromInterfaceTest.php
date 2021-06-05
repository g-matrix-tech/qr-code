<?php

declare(strict_types=1);

namespace Tests\Unit\QrCodeFrom;

use PHPUnit\Framework\TestCase;
use GMatrixTech\QrCode\QrCodeFrom\QrCodeFromInterface;

class QrCodeFromInterfaceTest extends TestCase
{
    private $qrCodeFrom;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->qrCodeFrom = $this->initAnonymousObject();
    }

    public function testExistenceOfMethodExists()
    {
        $this->assertTrue(method_exists($this->qrCodeFrom, 'value'));
    }

    public function testTypeOfReturnedDataOfMethodExists()
    {
        $result = $this->qrCodeFrom->value();

        $this->assertSame(['some_qr_code'], $result);
    }

    private function initAnonymousObject(): QrCodeFromInterface
    {
        return
            new class implements QrCodeFromInterface {
                public function value(): array
                {
                    return ['some_qr_code'];
                }
            };
    }
}

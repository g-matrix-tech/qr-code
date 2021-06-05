<?php

declare(strict_types=1);

namespace Tests\Unit\QrCodeRender;

use PHPUnit\Framework\TestCase;
use GMatrixTech\QrCode\QrCodeRender\QrCodeRenderInterface;

class QrCodeRenderInterfaceTest extends TestCase
{
    private $qrCodeRender;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->qrCodeRender = $this->initAnonymousObject();
    }

    public function testExistenceOfMethodExists()
    {
        $this->assertTrue(method_exists($this->qrCodeRender, 'run'));
    }

    public function testTypeOfReturnedDataOfMethodExists()
    {
        $result = $this->qrCodeRender->run('some_path');

        $this->assertSame(['some data'], $result);
    }

    private function initAnonymousObject(): QrCodeRenderInterface
    {
        return
            new class implements QrCodeRenderInterface {
                public function run(string $imagePath): array
                {
                    return ['some data'];
                }
            };
    }
}

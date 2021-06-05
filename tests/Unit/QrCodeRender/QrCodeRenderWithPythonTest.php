<?php

declare(strict_types=1);

namespace Tests\Unit\QrCodeRender;

use PHPUnit\Framework\TestCase;
use GMatrixTech\QrCode\QrCodeRender\QrCodeRenderWithPython;
use GMatrixTech\Exception\BaseException;

class QrCodeRenderWithPythonTest extends TestCase
{
    private $imageOneQrCode;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->imageOneQrCode = [
            'code' => 'ok',
            'result' => [
                [
                    'barcodeFormat' => 'QR_CODE',
                    'barcodeText' => 't=20201221T0905&s=270.00&fn=9282440300853009&i=2353&fp=2862508635&n=1',
                ],
            ],
        ];
    }

    public function testSuccess()
    {
        $image = __DIR__ . "/../../files/qrcodes_images/imageOne.png";

        $qrCode = (
            new QrCodeRenderWithPython()
        )
            ->run($image);

        $this->assertSame($this->imageOneQrCode, $qrCode);
    }

    public function testFileWithoutQrCode()
    {
        $image = __DIR__ . '/../../files/qrcodes_images/imageWithoutQrCode.jpg';

        $err_msg = json_encode([
            'currentService' => '',
            'code' => 0,
            'file' => '/var/www/src/QrCodeRender/QrCodeRenderWithPython.php',
            'line' => 70,
            'message' => 'Original system could not scan Qr-code.',
        ]);

        $this->expectException(BaseException::class);
        $this->expectErrorMessage($err_msg);

        (
            new QrCodeRenderWithPython()
        )
            ->run($image);
    }

    public function testFileDoesNotExist()
    {
        $image = __DIR__ . '/../../files/qrcodes_images/FileDoesNotExist.jpg';


        $err_msg = json_encode([
            'currentService' => '',
            'code' => 0,
            'file' => '/var/www/src/QrCodeRender/QrCodeRenderWithPython.php',
            'line' => 70,
            'message' => 'The file is not found. /var/www/tests/Unit/QrCodeRender/../../files/qrcodes_images/FileDoesNotExist.jpg',
        ]);

        $this->expectException(BaseException::class);
        $this->expectErrorMessage($err_msg);

        (
            new QrCodeRenderWithPython()
        )
            ->run($image);
    }
}

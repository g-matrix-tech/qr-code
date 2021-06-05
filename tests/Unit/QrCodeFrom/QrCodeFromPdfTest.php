<?php

declare(strict_types=1);

namespace Tests\Unit\QrCodeFrom;

use PHPUnit\Framework\TestCase;
use GMatrixTech\QrCode\QrCodeFrom\QrCodeFromPdf;
use GMatrixTech\QrCode\File\Pdf;
use GMatrixTech\QrCode\QrCodeRender\QrCodeRenderWithPython;
use GMatrixTech\Exception\BaseException;

class QrCodeFromPdfTest extends TestCase
{
    private $pdfOneQrCode;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->pdfOneQrCode = [
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
        $pdf = __DIR__ . "/../../files/qrcodes_pdf/pdfOne.pdf";

        $resultQrCode = (
            new QrCodeFromPdf(
                new Pdf($pdf),
                new QrCodeRenderWithPython()
            )
        )
            ->value();

        $this->assertSame($this->pdfOneQrCode, $resultQrCode);
    }

    public function testFail()
    {
        $pdf = __DIR__ . "/../../files/qrcodes_pdf/pdfTwo.pdf";

        $resultQrCode = (
            new QrCodeFromPdf(
                new Pdf($pdf),
                new QrCodeRenderWithPython()
            )
        )
            ->value();

        $this->assertNotSame($this->pdfOneQrCode, $resultQrCode);
    }

    public function testPdfWithoutQrCode()
    {
        $pdf = __DIR__ . "/../../files/qrcodes_pdf/pdfWithoutQrCode.pdf";

        $this->expectException(BaseException::class);
        $this->expectErrorMessage('Original system could not scan Qr-code.');

        (
            new QrCodeFromPdf(
                new Pdf($pdf),
                new QrCodeRenderWithPython()
            )
        )
            ->value();
    }
}

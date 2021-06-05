<?php

declare(strict_types=1);

namespace Tests\Unit\Helper;

use PHPUnit\Framework\TestCase;
use GMatrixTech\QrCode\Helper\QrCodeHelper;
use GMatrixTech\Exception\BaseException;

class QrCodeHelperTest extends TestCase
{
    private $qrCode;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->qrCode = [
            'code' => 'ok',
            'result' => [
                [
                    'barcodeFormat' => 'QR_CODE',
                    'barcodeText' => 't=20201221T0905&s=270.00&fn=9282440300853009&i=2353&fp=2862508635&n=1',
                ],
            ],
        ];
    }

    // Begin testing "getQrCodeFromImage"
    public function testGetQrCodeFromImageSuccess()
    {
        $image = __DIR__ . "/../../files/qrcodes_images/imageOne.png";

        $resultQrCode = QrCodeHelper::getQrCodeFromImage($image);

        $this->assertSame($this->qrCode, $resultQrCode);
    }

    public function testGetQrCodeFromImageFail()
    {
        $image = __DIR__ . "/../../files/qrcodes_images/imageTwo.png";

        $resultQrCode = QrCodeHelper::getQrCodeFromImage($image);
        $this->assertNotSame($this->qrCode, $resultQrCode);
    }

    public function testGetQrCodeFromImageWithoutQrCode()
    {
        $image = __DIR__ . "/../../files/qrcodes_images/imageWithoutQrCode.jpg";

        $err_msg = json_encode([
            'currentService' => '',
            'code' => 0,
            'file' => '/var/www/src/QrCodeRender/QrCodeRenderWithPython.php',
            'line' => 70,
            'message' => 'Original system could not scan Qr-code.',
        ]);

        $this->expectException(BaseException::class);
        $this->expectErrorMessage($err_msg);

        QrCodeHelper::getQrCodeFromImage($image);
    }

    public function testImageThatDoesNotExist()
    {
        $image = __DIR__ . '/../../files/qrcodes_images/imageThatDoesNotExist.jpg';

        $err_msg = json_encode([
            'currentService' => '',
            'code' => 0,
            'file' => '/var/www/src/File/Image.php',
            'line' => 39,
            'message' => 'File not found: /var/www/tests/Unit/Helper/../../files/qrcodes_images/imageThatDoesNotExist.jpg',
        ]);

        $this->expectException(BaseException::class);
        $this->expectErrorMessage($err_msg);

        QrCodeHelper::getQrCodeFromImage($image);
    }
    // End testing "getQrCodeFromImage"

    // Begin testing "getQrCodeFromPdf"
    public function testGetQrCodeFromPdfSuccess()
    {
        $pdf = __DIR__ . "/../../files/qrcodes_pdf/pdfOne.pdf";

        $resultQrCode = QrCodeHelper::getQrCodeFromPdf($pdf);

        $this->assertSame($this->qrCode, $resultQrCode);
    }

    public function testGetQrCodeFromPdfFail()
    {
        $pdf = __DIR__ . "/../../files/qrcodes_pdf/pdfTwo.pdf";

        $resultQrCode = QrCodeHelper::getQrCodeFromPdf($pdf);

        $this->assertNotSame($this->qrCode, $resultQrCode);
    }

    public function testGetQrCodeFromPdfWithoutQrCode()
    {
        $pdf = __DIR__ . "/../../files/qrcodes_pdf/pdfWithoutQrCode.pdf";

        $err_msg = json_encode([
            'currentService' => '',
            'code' => 0,
            'file' => '/var/www/src/QrCodeRender/QrCodeRenderWithPython.php',
            'line' => 70,
            'message' => 'Original system could not scan Qr-code.',
        ]);

        $this->expectException(BaseException::class);
        $this->expectErrorMessage($err_msg);

        QrCodeHelper::getQrCodeFromPdf($pdf);
    }

    public function testPdfThatDoesNotExist()
    {
        $pdf = __DIR__ . '/../../files/qrcodes_pdf/pdfThatDoesNotExist.pdf';

        $err_msg = json_encode([
            'currentService' => '',
            'code' => 0,
            'file' => '/var/www/src/File/Pdf.php',
            'line' => 39,
            'message' => 'File not found: /var/www/tests/Unit/Helper/../../files/qrcodes_pdf/pdfThatDoesNotExist.pdf',
        ]);

        $this->expectException(BaseException::class);
        $this->expectErrorMessage($err_msg);

        QrCodeHelper::getQrCodeFromPdf($pdf);
    }
    // End testing "getQrCodeFromPdf"
}

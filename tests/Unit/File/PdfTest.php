<?php

declare(strict_types=1);

namespace Tests\Unit\File;

use GMatrixTech\Exception\BaseException;
use PHPUnit\Framework\TestCase;
use GMatrixTech\QrCode\File\Pdf;

class PdfTest extends TestCase
{
    private $pdfPath;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->pdfPath = __DIR__ . '/../../files/qrcodes_pdf/pdfWithoutQrCode.pdf';
    }

    public function testInputPathIsOutputPath()
    {
        $path = (
            new Pdf($this->pdfPath)
        )
            ->path();

        $this->assertSame($this->pdfPath, $path);
    }

    public function testFileDoesNotExist()
    {
        $filePath = 'this_file_does_not_exists';

        $err_msg = json_encode([
            'currentService' => '',
            'code' => 0,
            'file' => '/var/www/src/File/Pdf.php',
            'line' => 39,
            'message' => 'File not found: this_file_does_not_exists',
        ]);

        $this->expectException(BaseException::class);
        $this->expectErrorMessage($err_msg);

        (
            new Pdf($filePath)
        )
            ->path();
    }
}

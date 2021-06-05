<?php

declare(strict_types=1);

namespace Tests\Unit\File;

use PHPUnit\Framework\TestCase;
use GMatrixTech\QrCode\File\Image;
use GMatrixTech\Exception\BaseException;

class ImageTest extends TestCase
{
    private $imagePath;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->imagePath = __DIR__ . '/../../files/qrcodes_images/imageWithoutQrCode.jpg';
    }

    public function testInputPathIsOutputPath()
    {
        $path = (
            new Image($this->imagePath)
        )
            ->path();

        $this->assertSame($this->imagePath, $path);
    }

    public function testFileDoesNotExist()
    {
        $filePath = 'this_file_does_not_exists';

        $err_msg = json_encode([
            'currentService' => '',
            'code' => 0,
            'file' => '/var/www/src/File/Image.php',
            'line' => 39,
            'message' => 'File not found: this_file_does_not_exists',
        ]);

        $this->expectException(BaseException::class);
        $this->expectErrorMessage($err_msg);

        (
           new Image($filePath)
        )
            ->path();
    }
}

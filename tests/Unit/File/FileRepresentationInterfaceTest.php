<?php

declare(strict_types=1);

namespace Tests\Unit\File;

use PHPUnit\Framework\TestCase;
use GMatrixTech\QrCode\File\FileRepresentationInterface;

class FileRepresentationInterfaceTest extends TestCase
{
    private $fileRepresentation;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->fileRepresentation = $this->initAnonymousObject();
    }

    public function testExistenceOfMethodExists()
    {
        $this->assertTrue(method_exists($this->fileRepresentation, 'path'));
    }

    public function testTypeOfReturnedDataOfMethodExists()
    {
        $result = $this->fileRepresentation->path();

        $this->assertSame('some_file', $result);
    }

    private function initAnonymousObject(): FileRepresentationInterface
    {
        return
            new class implements FileRepresentationInterface {
                public function path(): string
                {
                    return 'some_file';
                }
            };
    }
}

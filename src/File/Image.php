<?php

declare(strict_types=1);

namespace GMatrixTech\QrCode\File;

use GMatrixTech\Exception\BaseException;

/**
 * Class Image
 * @package Ms\QrCode\File
 */
class Image implements FileRepresentationInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * Image constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     * @throws BaseException
     */
    public function path(): string
    {
        if (file_exists($this->path)) {
            return $this->path;
        }

        throw new BaseException('File not found: ' . $this->path);
    }
}

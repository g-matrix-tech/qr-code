<?php

declare(strict_types=1);

namespace GMatrixTech\QrCode\File;

/**
 * Interface FileRepresentationInterface
 * @package Ms\QrCode\File
 */
interface FileRepresentationInterface
{
    /**
     * @return string
     */
    public function path(): string;
}

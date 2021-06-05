<?php

declare(strict_types=1);

namespace GMatrixTech\QrCode\QrCodeRender;

/**
 * Interface QrCodeRenderInterface
 * @package Ms\QrCode\QrCodeRender
 */
interface QrCodeRenderInterface
{
    /**
     * @param string $imagePath
     * @return array
     */
    public function run(string $imagePath): array;
}

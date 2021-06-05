<?php

declare(strict_types=1);

namespace GMatrixTech\QrCode;

/**
 * Class Config
 * @package Ms\QrCode
 */
class Config
{
    /**
     * @return string[]
     */
    public function value(): array
    {
        return [
            'qr_code_reader_path' => __DIR__ . '/../python/BarcodeReadDemo_python.py'
        ];
    }
}

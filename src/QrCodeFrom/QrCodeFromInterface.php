<?php

declare(strict_types=1);

namespace GMatrixTech\QrCode\QrCodeFrom;

/**
 * Interface QrCodeFromInterface
 * @package Ms\QrCode\QrCodeFrom
 */
interface QrCodeFromInterface
{
    /**
     * @return array
     */
    public function value(): array;
}

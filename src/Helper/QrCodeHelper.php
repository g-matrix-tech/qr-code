<?php

declare(strict_types=1);

namespace GMatrixTech\QrCode\Helper;

use GMatrixTech\QrCode\File\Image;
use GMatrixTech\QrCode\File\Pdf;
use GMatrixTech\QrCode\QrCodeFrom\QrCodeFromImage;
use GMatrixTech\QrCode\QrCodeFrom\QrCodeFromPdf;
use GMatrixTech\QrCode\QrCodeRender\QrCodeRenderWithPython;

/**
 * Class QrCodeHelper
 * @package Ms\QrCode\Helper
 */
class QrCodeHelper
{
    /**
     * @param string $imagePath
     * @return array
     */
    public static function getQrCodeFromImage(string $imagePath): array
    {
        return (
            new QrCodeFromImage(
                new Image($imagePath),
                new QrCodeRenderWithPython()
            )
        )
            ->value();
    }

    /**
     * @param string $pdfPath
     * @return array
     */
    public static function getQrCodeFromPdf(string $pdfPath): array
    {
        return (
            new QrCodeFromPdf(
                new Pdf($pdfPath),
                new QrCodeRenderWithPython()
            )
        )
            ->value();
    }
}


<?php

declare(strict_types=1);

namespace GMatrixTech\QrCode\QrCodeFrom;

use GMatrixTech\QrCode\File\FileRepresentationInterface;
use GMatrixTech\QrCode\QrCodeRender\QrCodeRenderInterface;

/**
 * Class QrCodeFromPdf
 * @package Ms\QrCode\QrCodeFrom
 */
class QrCodeFromPdf implements QrCodeFromInterface
{
    /**
     * @var string
     */
    private $pdfPath;

    /**
     * @var QrCodeRenderInterface
     */
    private $qrCodeRender;

    /**
     * QrCodeFromPdf constructor.
     * @param FileRepresentationInterface $file
     * @param QrCodeRenderInterface $qrCodeRender
     */
    public function __construct(FileRepresentationInterface $file, QrCodeRenderInterface $qrCodeRender)
    {
        $this->pdfPath = $file->path();
        $this->qrCodeRender = $qrCodeRender;
    }

    /**
     * @return array
     */
    public function value(): array
    {
        return $this->qrCodeRender->run($this->pdfPath);
    }
}

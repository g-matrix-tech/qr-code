<?php

declare(strict_types=1);

namespace GMatrixTech\QrCode\QrCodeFrom;

use GMatrixTech\QrCode\File\FileRepresentationInterface;
use GMatrixTech\QrCode\QrCodeRender\QrCodeRenderInterface;

/**
 * Class QrCodeFromImage
 * @package Ms\QrCode\QrCodeFrom
 */
class QrCodeFromImage implements QrCodeFromInterface
{
    /**
     * @var string
     */
    private $imagePath;

    /**
     * @var QrCodeRenderInterface
     */
    private $qrCodeRender;

    /**
     * QrCodeFromImage constructor.
     * @param FileRepresentationInterface $file
     * @param QrCodeRenderInterface $qrCodeRender
     */
    public function __construct(FileRepresentationInterface $file, QrCodeRenderInterface $qrCodeRender)
    {
        $this->imagePath = $file->path();
        $this->qrCodeRender = $qrCodeRender;
    }

    /**
     * @return array
     */
    public function value(): array
    {
        return $this->qrCodeRender->run($this->imagePath);
    }
}

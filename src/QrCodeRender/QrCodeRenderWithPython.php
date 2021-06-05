<?php

declare(strict_types=1);

namespace GMatrixTech\QrCode\QrCodeRender;

use GMatrixTech\QrCode\Config;
use GMatrixTech\Exception\BaseException;

/**
 * Class QrCodeRenderWithPython
 * @package Ms\QrCode\QrCodeRender
 */
class QrCodeRenderWithPython implements QrCodeRenderInterface
{
    /**
     * @var string
     */
    private $programmingLanguageRunner = 'python3';

    /**
     * @param string $imagePath
     * @return array
     * @throws BaseException
     *
     * Success [
     *       "code" => ok,
     *       "result" => [
     *           [
     *               "barcodeFormat" => QR_CODE / PDF417 / DATAMATRIX / MAXICODE / AZTEC_CODE / DOTCODE
     *               "barcodeText" => "https://apteka-sklad.com/"
     *           ],
     *           [
     *               "barcodeFormat" => QR_CODE / PDF417 / DATAMATRIX / MAXICODE / AZTEC_CODE / DOTCODE
     *               "barcodeText" => "t=20210303T1440&s=350.00&fn=9251440300125402&i=24627&fp=1563898655&n=1"
     *           ]
     *       ]
     * ]
     *
     * Error [
     *     "code" => "error",
     *     "result" => [
     *         "message" => "Error message..."
     *     ]
     * ]
     */
    public function run(string $imagePath): array
    {
        $config = (
        new Config()
        )
            ->value();

        $command = sprintf(
            '%s %s %s',
            $this->programmingLanguageRunner,
            $config['qr_code_reader_path'],
            $imagePath
        );

        exec($command, $_output);

        $output = json_decode($_output[0], true);

        if (empty($output)) {
            throw new BaseException('Error while recognizing qr code.');
        } elseif ($output['code'] === 'error' && isset($output['result']['code'])) {
            throw new BaseException($output['result']['message']);
        } elseif ($output['code'] === 'error') {
            throw new BaseException($output['result']['message']);
        }

        if ($output['code'] === 'ok') {
            $result = array_map(function($item) {
                $_result = explode(" ", $item['barcodeText']);

                if (count($_result) > 1) {
                    $item['barcodeText'] = $_result[1];
                } else {
                    $item['barcodeText'] = $_result[0];
                }

                return $item;
            }, $output['result']);

            $output['result'] = $result;
            return $output;

        } else {
            throw new BaseException('Scanned Qr-code invalid answer.');
        }
    }
}

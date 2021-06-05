## About

This library helps you to scan Qr-code from image, pdf.

Here we use scan system (written by python) from Dynamsoft (for more go through the link https://www.dynamsoft.com/)


## Usage

Use GMatrixTech\QrCode\Helper\QrCodeHelper (Facade pattern) to easily use the functionality of library

Some examples

```php
use GMatrixTech\QrCode\Helper\QrCodeHelper;

$qrCodeFromImage = QrCodeHelper::getQrCodeFromImage('path_to_image');

$qrCodeFromPdf = QrCodeHelper::getQrCodeFromPdf('path_to_pdf');

Success:
[
    'code' => 'ok',
    'result' => [
        [
            'barcodeFormat' => 'QR_CODE', // PDF417 / DATAMATRIX / MAXICODE / AZTEC_CODE / DOTCODE
            'barcodeText' => 't=20201221T0905&s=270.00&fn=9282440300853009&i=2353&fp=2862508635&n=1',
        ],
        [
            "barcodeFormat" => 'QR_CODE', // PDF417 / DATAMATRIX / MAXICODE / AZTEC_CODE / DOTCODE
            "barcodeText" => "https://apteka-sklad.com/"
        ]
    ],
];

Fail:
[
    'code' => 'error',
    'result' => [
        'message' => 'Error message...'
    ],
];
```

<?php

namespace App\Services;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\Output\QRGdImagePNG;

class QrCodeService
{
    /**
     * Generate QR Code PNG
     */
    public function generate(string $data): string
    {
        $directory = FCPATH . 'uploads/qrcode/';

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $filename = md5($data) . '.png';

        $filepath = $directory . $filename;

        // Jika file belum ada, generate sekali saja
        if (!file_exists($filepath)) {

            $options = new QROptions([
                'outputInterface' => QRGdImagePNG::class,
                'scale'           => 10,
                'imageBase64'     => false,
            ]);

            (new QRCode($options))->render($data, $filepath);
        }

        return base_url('uploads/qrcode/' . $filename);
    }
}
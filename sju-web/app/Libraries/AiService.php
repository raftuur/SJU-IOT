<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AiService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:8000/',
            'timeout'  => 60,
        ]);
    }

    /**
     * Kirim gambar ke AI Service
     */
    public function detect(string $imagePath): array
    {
        try {

            $response = $this->client->post('detect', [

                'multipart' => [

                    [

                        'name'     => 'file',

                        'contents' => fopen($imagePath, 'r'),

                        'filename' => basename($imagePath),

                    ],

                ],

            ]);

            return json_decode($response->getBody()->getContents(), true);

        } catch (RequestException $e) {

            $body = '';

            if ($e->hasResponse()) {

                $body = $e->getResponse()->getBody()->getContents();

            }

            return [

                'success' => false,

                'message' => $body ?: $e->getMessage(),

            ];

        } catch (\Throwable $e) {

            return [

                'success' => false,

                'message' => $e->getMessage(),

            ];

        }
    }

    /**
     * Cek status AI Service
     */
    public function health(): array
    {
        try {

            $response = $this->client->get('health');

            return json_decode($response->getBody()->getContents(), true);

        } catch (\Throwable $e) {

            return [

                'status' => 'offline',

                'message' => $e->getMessage(),

            ];

        }
    }
}
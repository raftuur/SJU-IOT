<?php

namespace App\Controllers;

use App\Libraries\AiService;
use App\Services\AiDetectionService;
use Ramsey\Uuid\Uuid;

class AiDetectionController extends BaseController
{
    protected AiDetectionService $aiDetectionService;

    public function __construct()
    {
        $this->aiDetectionService = new AiDetectionService();
    }

    /**
     * Daftar AI Detection
     */
    public function index()
    {
        $keyword = trim($this->request->getGet('keyword') ?? '');

        return view('admin/ai_detection/index', [

            'title'        => 'AI Detection',

            'pageTitle'    => 'AI Detection',

            'pageSubtitle' => 'Monitoring hasil deteksi Artificial Intelligence.',

            'keyword'      => $keyword,

            'statistics'   => $this->aiDetectionService->getStatistics(),

            'detections'   => $this->aiDetectionService->getAll($keyword),

        ]);
    }

    /**
     * Detail AI Detection
     */
    public function show($id)
    {
        $detection = $this->aiDetectionService->getDetail((int) $id);

        if (! $detection) {

            return redirect()
                ->to('/ai-detection')
                ->with('error', 'Data AI Detection tidak ditemukan.');

        }

        return view('admin/ai_detection/show', [

            'title'        => 'Detail AI Detection',

            'pageTitle'    => 'Detail AI Detection',

            'pageSubtitle' => 'Informasi hasil deteksi AI.',

            'detection'    => $detection,

        ]);
    }

    /**
     * Test AI Detection
     *
     * Khusus untuk pengujian AI.
     *
     * Tidak membuat:
     * - Transaction
     * - Wallet
     * - Point
     * - Machine Session
     */
    public function test()
    {
        $file = $this->request->getFile('image');

        if (! $file || ! $file->isValid()) {

            return redirect()
                ->back()
                ->with('error', 'Silakan pilih gambar terlebih dahulu.');

        }

        $uploadPath = WRITEPATH . 'uploads/ai';

        if (! is_dir($uploadPath)) {

            mkdir($uploadPath, 0777, true);

        }

        $fileName = $file->getRandomName();

        $file->move($uploadPath, $fileName);

        $imagePath = $uploadPath . DIRECTORY_SEPARATOR . $fileName;

        // Jalankan AI
        $ai = new AiService();

        $result = $ai->detect($imagePath);

        if (! ($result['success'] ?? false)) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    is_array($result['message'])
                        ? json_encode(
                            $result['message'],
                            JSON_PRETTY_PRINT
                        )
                        : $result['message']
                );

        }

        // Generate Detection ID
        $detectionId =
            $this->aiDetectionService->generateDetectionId();

        // Simpan hasil pengujian AI saja
        $save = $this->aiDetectionService->store([

            'uuid' => Uuid::uuid4()->toString(),

            'detection_id' => $detectionId,

            'bottle' => $result['summary']['bottle'],

            'cap' => $result['summary']['cap'],

            'label' => $result['summary']['label'],

            'confidence' => $result['confidence'],

            'original_image' => $result['original_image'],

            'detected_image' => $result['detected_image'],

            'json_result' => json_encode($result),

        ]);

        if (! $save) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Hasil AI gagal disimpan.'
                );

        }

        return redirect()
            ->to('/ai-detection')
            ->with(
                'success',
                'AI Detection berhasil diuji.'
            );
    }
}
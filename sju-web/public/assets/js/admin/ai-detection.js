document.addEventListener("DOMContentLoaded", () => {

    // =====================================================
    // NAVBAR / MOBILE SIDEBAR
    // =====================================================

    const menuToggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".sidebar");

    if (menuToggle && sidebar) {

        menuToggle.addEventListener("click", function (event) {

            event.stopPropagation();

            sidebar.classList.toggle("active");

        });


        // Klik area di luar sidebar
        document.addEventListener("click", function (event) {

            if (window.innerWidth > 992) {
                return;
            }

            if (!sidebar.classList.contains("active")) {
                return;
            }

            const clickedInsideSidebar =
                sidebar.contains(event.target);

            const clickedMenuToggle =
                menuToggle.contains(event.target);

            if (
                !clickedInsideSidebar &&
                !clickedMenuToggle
            ) {
                sidebar.classList.remove("active");
            }

        });

    }


    // =====================================================
    // AI CAMERA TEST
    // =====================================================

    const camera = document.getElementById("aiCamera");
    const canvas = document.getElementById("aiCanvas");

    const btnStartCamera = document.getElementById("btnStartCamera");
    const btnCapture = document.getElementById("btnCapture");
    const btnStopCamera = document.getElementById("btnStopCamera");

    const cameraPlaceholder =
        document.getElementById("cameraPlaceholder");

    const captureResult =
        document.getElementById("captureResult");

    const capturedImage =
        document.getElementById("capturedImage");

    let cameraStream = null;


    // =====================================================
    // BUKA KAMERA
    // =====================================================

    if (btnStartCamera && camera) {

        btnStartCamera.addEventListener("click", async function () {

            try {

                cameraStream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "environment"
                    },
                    audio: false
                });

                camera.srcObject = cameraStream;

                camera.style.display = "block";

                if (cameraPlaceholder) {
                    cameraPlaceholder.style.display = "none";
                }

                btnStartCamera.disabled = true;

                if (btnCapture) {
                    btnCapture.disabled = false;
                }

                if (btnStopCamera) {
                    btnStopCamera.disabled = false;
                }

            } catch (error) {

                console.error("Camera error:", error);

                alert(
                    "Kamera tidak dapat digunakan. Pastikan browser memiliki izin kamera."
                );

            }

        });

    }


    // =====================================================
    // AMBIL GAMBAR + JALANKAN AI
    // =====================================================

    if (btnCapture && camera && canvas) {

        btnCapture.addEventListener("click", function () {

            if (!cameraStream) {
                return;
            }

            if (!camera.videoWidth || !camera.videoHeight) {

                alert("Kamera belum siap.");

                return;
            }

            // Ukuran canvas mengikuti kamera
            canvas.width = camera.videoWidth;
            canvas.height = camera.videoHeight;

            const context = canvas.getContext("2d");

            context.drawImage(
                camera,
                0,
                0,
                canvas.width,
                canvas.height
            );

            // Tampilkan hasil capture sementara
            const imageData =
                canvas.toDataURL("image/jpeg", 0.9);

            if (capturedImage) {

                capturedImage.src = imageData;

            }

            if (captureResult) {

                captureResult.classList.remove("d-none");

            }

            // =================================================
            // KIRIM HASIL CAPTURE KE CODEIGNITER
            // =================================================

            canvas.toBlob(function (blob) {

                if (!blob) {

                    alert("Gagal mengambil gambar.");

                    return;
                }

                const formData = new FormData();

                // Nama harus "image" karena controller menggunakan:
                // $this->request->getFile('image')
                formData.append(
                    "image",
                    blob,
                    "camera-test.jpg"
                );


                // Ambil CSRF dari form upload
                const form =
                    document.querySelector(
                        'form[action*="ai-detection/test"]'
                    );

                if (form) {

                    const hiddenInputs =
                        form.querySelectorAll(
                            'input[type="hidden"]'
                        );

                    hiddenInputs.forEach(function (input) {

                        formData.append(
                            input.name,
                            input.value
                        );

                    });

                }


                // =================================================
                // DISABLE BUTTON
                // =================================================

                btnCapture.disabled = true;

                const originalText =
                    btnCapture.innerHTML;

                btnCapture.innerHTML =
                    '<i class="bi bi-hourglass-split"></i> Memproses AI...';


                // =================================================
                // KIRIM KE CONTROLLER
                // =================================================

                fetch(
                    btnCapture.dataset.aiTestUrl,
                    {
                        method: "POST",
                        body: formData,
                        credentials: "same-origin"
                    }
                )
                .then(function (response) {

                    if (!response.ok) {

                        throw new Error(
                            "Gagal menjalankan AI."
                        );

                    }

                    return response.text();

                })
                .then(function () {

                    // Controller akan:
                    //
                    // 1. menerima gambar
                    // 2. mengirim ke FastAPI /detect
                    // 3. menyimpan hasil ke ai_detections
                    // 4. redirect kembali ke /ai-detection
                    //
                    // Setelah selesai, reload halaman
                    // agar history menampilkan data terbaru.

                    window.location.reload();

                })
                .catch(function (error) {

                    console.error(
                        "AI Detection Error:",
                        error
                    );

                    alert(
                        "AI Detection gagal dijalankan."
                    );

                    btnCapture.disabled = false;

                    btnCapture.innerHTML =
                        originalText;

                });

            }, "image/jpeg", 0.9);

        });

    }


    // =====================================================
    // TUTUP KAMERA
    // =====================================================

    if (btnStopCamera) {

        btnStopCamera.addEventListener("click", function () {

            stopCamera();

        });

    }


    // =====================================================
    // FUNGSI STOP CAMERA
    // =====================================================

    function stopCamera() {

        if (cameraStream) {

            cameraStream.getTracks().forEach(function (track) {

                track.stop();

            });

            cameraStream = null;

        }

        if (camera) {

            camera.srcObject = null;

            camera.style.display = "none";

        }

        if (cameraPlaceholder) {

            cameraPlaceholder.style.display = "flex";

        }

        if (btnStartCamera) {

            btnStartCamera.disabled = false;

        }

        if (btnCapture) {

            btnCapture.disabled = true;

        }

        if (btnStopCamera) {

            btnStopCamera.disabled = true;

        }

    }


    // =====================================================
    // DETAIL AI DETECTION
    // =====================================================

    const buttons = document.querySelectorAll(".btn-detail");

    buttons.forEach(button => {

        button.addEventListener("click", function () {

            document.getElementById("detectionId").textContent =
                this.dataset.detectionId;

            document.getElementById("confidence").textContent =
                this.dataset.confidence + "%";

            document.getElementById("bottle").innerHTML =
                this.dataset.bottle == 1
                    ? '<span class="badge bg-success">Detected</span>'
                    : '<span class="badge bg-danger">Not Detected</span>';

            document.getElementById("cap").innerHTML =
                this.dataset.cap == 1
                    ? '<span class="badge bg-success">Detected</span>'
                    : '<span class="badge bg-danger">Not Detected</span>';

            document.getElementById("label").innerHTML =
                this.dataset.label == 1
                    ? '<span class="badge bg-success">Detected</span>'
                    : '<span class="badge bg-danger">Not Detected</span>';

            document.getElementById("status").innerHTML =
                this.dataset.bottle == 1
                    ? '<span class="badge bg-success">VALID</span>'
                    : '<span class="badge bg-danger">INVALID</span>';

            document.getElementById("originalImage").src =
                "/ai-uploads" + this.dataset.originalImage.replace("/uploads", "");

            document.getElementById("detectedImage").src =
                "/ai-uploads" + this.dataset.detectedImage.replace("/uploads", "");

        });

    });


    // =====================================================
    // IMAGE PREVIEW
    // =====================================================

    const thumbs = document.querySelectorAll(".detection-thumb");

    thumbs.forEach(img => {

        img.addEventListener("click", function () {

            document.getElementById("previewImage").src =
                this.src;

            const modal = new bootstrap.Modal(
                document.getElementById("imageModal")
            );

            modal.show();

        });

    });

});